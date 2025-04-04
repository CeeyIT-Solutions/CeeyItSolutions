<?php

namespace App\Http\Controllers\Gateway;

use App\Models\User;
use App\Models\Course;
use App\Models\Deposit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Models\AdminNotification;
use App\Http\Controllers\Controller;
use App\Models\UserCourse;

class PaymentController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }

    public function payment($code)
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();

        $course = Course::where('code',$code)->first();
        if(!$course){
            $notify[]=['error','Course not found'];
            return back()->withNotify($notify);
        }

        if(session('newPrice'))      $amount = getAmount(session('newPrice'));
        elseif($course->discount)    $amount = getAmount($course->discountPrice());
        else                         $amount = getAmount($course->price);
        
        session()->put('payment',1);
        $pageTitle = 'Payment Methods';
        return view($this->activeTemplate . 'user.payment.purchase', compact('gatewayCurrency','course','pageTitle','amount'));
    }
    public function deposit()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Deposit Methods';
        return view($this->activeTemplate . 'user.payment.deposit', compact('gatewayCurrency', 'pageTitle'));
    }

    public function depositInsert(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency' => 'required',
        ]);


        $user = auth()->user();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow payment limit'];
            return back()->withNotify($notify);
        }

        $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable = $request->amount + $charge;
        $final_amo = $payable * $gate->rate;

        $data = new Deposit();
        $data->user_id = $user->id;
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount = $request->amount;
        $data->charge = $charge;
        $data->rate = $gate->rate;
        $data->final_amo = $final_amo;
        $data->btc_amo = 0;
        $data->btc_wallet = "";
        $data->trx = getTrx();
        $data->course_id = $request->course_id ?? null;
        $data->try = 0;
        $data->status = 0;
        $data->save();
        session()->forget('newPrice');
        session()->put('Track', $data->trx);
        return redirect()->route('user.deposit.preview');
    }


    public function depositPreview()
    {

        $track = session()->get('Track');
        $data = Deposit::where('trx', $track)->where('status',0)->orderBy('id', 'DESC')->firstOrFail();
        $pageTitle = 'Payment Preview';
        return view($this->activeTemplate . 'user.payment.preview', compact('data', 'pageTitle'));
    }


    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status',0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();
        
    
        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);

// dd($data);
        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if(@$data->session){
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($trx)
    {
        $general = GeneralSetting::first();
        $data = Deposit::where('trx', $trx)->first();
        if ($data->status == 0) {
            $data->status = 1;
            $data->save();

            $user = User::find($data->user_id);
            $user->balance += $data->amount;
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $data->user_id;
            $transaction->amount = $data->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = $data->charge;
            $transaction->trx_type = '+';
            $transaction->details = 'Deposit Via ' . $data->gatewayCurrency()->name;
            $transaction->trx = $data->trx;
            $transaction->save();

            if($data->course_id){
                $course = Course::find($data->course_id);
                
                $user->balance -= $data->amount;
                $user->save();

                $transaction = new Transaction();
                $transaction->user_id = $data->user_id;
                $transaction->amount = $data->amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge = $data->charge;
                $transaction->trx_type = '-';
                $transaction->details = 'Payment for ' . $course->title;
                $transaction->trx = $data->trx;
                $transaction->save();

                $author = User::find($course->author_id);
                $author->balance += $data->amount;
                $author->save();

                $transaction = new Transaction();
                $transaction->user_id = $author->id;
                $transaction->amount = $data->amount;
                $transaction->post_balance = $author->balance;
                $transaction->charge = $data->charge;
                $transaction->trx_type = '+';
                $transaction->details = 'Payment for ' . $course->title;
                $transaction->trx = $data->trx;
                $transaction->save();

                $userCourse = new UserCourse();
                $userCourse->user_id = $user->id;
                $userCourse->course_id = $course->id;
                $userCourse->author_id = $course->author_id;
                $userCourse->status = $course->value == 1 ? "success" : "pending";
                $userCourse->save();

                notify($user, 'PURCHASE_COURSE', [
                    'course_name' => $course->title,
                    'course_code' => $course->code,
                    'amount' => getAmount($course->price),
                    'trx' => $data->trx,
                    'currency' => $general->cur_text,
                    'time' => showDateTime($userCourse->created_at,'d M Y @ h:i:a'),
                ]);

            }

            $adminNotification = new AdminNotification();
            $adminNotification->user_id = $user->id;
            $adminNotification->title = 'Deposit successful via '.$data->gatewayCurrency()->name;
            $adminNotification->click_url = urlPath('admin.deposit.successful');
            $adminNotification->save();

            notify($user, 'DEPOSIT_COMPLETE', [
                'method_name' => $data->gatewayCurrency()->name,
                'method_currency' => $data->method_currency,
                'method_amount' => getAmount($data->final_amo),
                'amount' => getAmount($data->amount),
                'charge' => getAmount($data->charge),
                'currency' => $general->cur_text,
                'rate' => getAmount($data->rate),
                'trx' => $data->trx,
                'post_balance' => getAmount($user->balance)
            ]);


        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {

            $pageTitle = 'Payment Confirm';
            $method = $data->gatewayCurrency();
            return view($this->activeTemplate . 'user.manual_payment.manual_confirm', compact('data', 'pageTitle', 'method'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route(gatewayRedirectUrl());
        }

        $params = json_decode($data->gatewayCurrency()->gateway_parameter);

        $rules = [];
        $inputField = [];
        $verifyImages = [];

        if ($params != null) {
            foreach ($params as $key => $custom) {
                $rules[$key] = [$custom->validation];
                if ($custom->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg','jpeg','png']));
                    array_push($rules[$key], 'max:2048');

                    array_push($verifyImages, $key);
                }
                if ($custom->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($custom->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        $this->validate($request, $rules);


        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['deposit']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $inKey];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $data->detail = $reqField;
        } else {
            $data->detail = null;
        }



        $data->status = 2; // pending
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Deposit request from '.$data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details',$data->id);
        $adminNotification->save();

        $general = GeneralSetting::first();
        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => getAmount($data->final_amo),
            'amount' => getAmount($data->amount),
            'charge' => getAmount($data->charge),
            'currency' => $general->cur_text,
            'rate' => getAmount($data->rate),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'You have payment request has been taken.'];
        return redirect()->route('user.deposit.history')->withNotify($notify);
    }


}
