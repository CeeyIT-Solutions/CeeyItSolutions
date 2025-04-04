<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Comment;
use App\Models\CouponUser;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Rules\FileTypeValidate;
use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    
    public function home()
    {
       
        $pageTitle = 'Dashboard';
        $user = auth()->user();
        
        $trxs = Transaction::where('user_id',auth()->id())->latest()->take(10)->get();
        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle','user','trxs'));
    }

    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user = Auth::user();
        return view($this->activeTemplate. 'user.profile_setting', compact('pageTitle','user'));
    }

    public function trxHistory()
    {
        $pageTitle = "Transaction History";
        $trxs = Transaction::latest()->paginate(getPaginate());
        return view($this->activeTemplate.'user.trx_history',compact('pageTitle','trxs'));
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'address' => 'sometimes|required|max:80',
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|max:40',
            'city' => 'sometimes|required|max:50',
            'image' => ['image',new FileTypeValidate(['jpg','jpeg','png'])]
        ],[
            'firstname.required'=>'First name field is required',
            'lastname.required'=>'Last name field is required'
        ]);

        $user = Auth::user();

        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$user->address->country,
            'city' => $request->city,
        ];
        if( $user->is_instructor == 1){
            $in['instructor_info'] = [
                'detail' => $request->detail,
            ];
        }


        if ($request->hasFile('image')) {
            $location = imagePath()['profile']['user']['path'];
            $size = imagePath()['profile']['user']['size'];
            $filename = uploadImage($request->image, $location, $size, $user->image);
            $in['image'] = $filename;
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {

        $password_validation = Password::min(6);
        $general = GeneralSetting::first();
        if ($general->secure_password) {
            $password_validation = $password_validation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required','confirmed',$password_validation]
        ]);
        

        try {
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                $notify[] = ['success', 'Password changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'The password doesn\'t match!'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        $pageTitle = 'Deposit History';
        $emptyMessage = 'No history found.';
        $logs = auth()->user()->deposits()->with(['gateway'])->orderBy('id','desc')->paginate(getPaginate());
        return view($this->activeTemplate.'user.deposit_history', compact('pageTitle', 'emptyMessage', 'logs'));
    }

    /*
     * Withdraw Operation
     */

    public function withdrawMoney()
    {
        
        $withdrawMethod = WithdrawMethod::where('status',1)->get();
        $pageTitle = 'Withdraw Money';
        return view($this->activeTemplate.'user.withdraw.methods', compact('pageTitle','withdrawMethod'));
    }

    public function withdrawStore(Request $request)
    {

        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);

        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
            return back()->withNotify($notify);
        }

        if ($request->amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for withdraw.'];
            return back()->withNotify($notify);
        }


        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('user.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        return view($this->activeTemplate . 'user.withdraw.preview', compact('pageTitle','withdraw'));
    }


    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg','jpeg','png']));
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);
        
        $user = auth()->user();
        if ($user->ts) {
            $response = verifyG2fa($user,$request->authenticator_code);
            if (!$response) {
                $notify[] = ['error', 'Wrong verification code'];
                return back()->withNotify($notify);
            }   
        }


        if ($withdraw->amount > $user->balance) {
            $notify[] = ['error', 'Your request amount is larger then your current balance.'];
            return back()->withNotify($notify);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
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
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
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
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        $user->balance  -=  $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $withdraw->charge;
        $transaction->trx_type = '-';
        $transaction->details = getAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx =  $withdraw->trx;
        $transaction->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New withdraw request from '.$user->username;
        $adminNotification->click_url = urlPath('admin.withdraw.details',$withdraw->id);
        $adminNotification->save();

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => getAmount($withdraw->final_amount),
            'amount' => getAmount($withdraw->amount),
            'charge' => getAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => getAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => getAmount($user->balance),
            'delay' => $withdraw->method->delay
        ]);

        $notify[] = ['success', 'Withdraw request sent successfully'];
        return redirect()->route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $pageTitle = "Withdraw Log";
        $withdraws = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id','desc')->paginate(getPaginate());
        $data['emptyMessage'] = "No Data Found!";
        return view($this->activeTemplate.'user.withdraw.log', compact('pageTitle','withdraws'));
    }



    public function show2faForm()
    {
        $general = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view($this->activeTemplate.'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function becomeInstructor()
    {
        $pageTitle = "Become Instructor";
        if(auth()->user()->is_instructor == 2){
            $notify[]=['error','Sorry! You have already applied for instructor'];
            return redirect(route('user.home'))->withNotify($notify);
        }
        if(auth()->user()->is_instructor == 1){
            $notify[]=['error','Sorry! You are already an instructor'];
            return redirect(route('user.home'))->withNotify($notify);
        }
        return view($this->activeTemplate.'user.become_instructor',compact('pageTitle'));
    }

    public function applyAsInstructor(Request $request)
    {
        $request->validate([
            'fname'=> 'required',
            'lname'=> 'required',
            'email'=> 'required|email',
            'mobile'=> 'required',
            'occupation'=> 'required',
            'detail'=> 'required',
            'resume'=> 'required|mimes:pdf|max:5120',
        ]);

        $user = auth()->user();
        if($request->resume){
            $resume = uploadFile($request->resume,'assets/admin/instructor/');
        }
        $user->instructor_info = [
            'firstname' => $request->fname,
            'lastname' => $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'occupation' => $request->occupation,
            'detail' => $request->detail,
            'resume' => $resume
        ];
        $user->is_instructor = 2;
        $user->update();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New application for instructor.';
        $adminNotification->click_url = urlPath('admin.instructor.pending');
        $adminNotification->save();


        $notify[]=['success','Your Application has been submitted for review'];
        return redirect(route('user.home'))->withNotify($notify);

    }

    public function applyCoupon(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'coupon'=> 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $coupon = Coupon::where('coupon_code','=',strtoupper($request->coupon))->where('status','=',1)->first();

        if(!$coupon){
            return response()->json(['coupon'=>['Sorry! Invalid coupon']]);
        }

        if($coupon->use_limit <= 0){
            return response()->json(['coupon'=>['Sorry! Coupon limit has been reached']]);
        }
        if($coupon->start_date > Carbon::now()->toDateString()){
            return response()->json(['coupon'=>['Sorry! Coupon is not valid in this date']]);
        }
        if($coupon->end_date < Carbon::now()->toDateString()){
            return response()->json(['coupon'=>['Sorry! Coupon has been expired']]);
            $coupon->status = 0;
            $coupon->update();
        }


        $general = GeneralSetting::first();
        $course = Course::find($request->course_id);
        $price = $course->discount ? $course->discountPrice() : $course->price;
        if(!$course){
            return response()->json(['coupon'=>['Sorry! Something went wrong']]);
        }
        $couponUser = CouponUser::where('user_id',auth()->id())->where('coupon_id',$coupon->id)->get();
      
        if($price < $coupon->min_order_amount){
            return response()->json(['coupon'=>["Sorry! Minimum course price is required for this coupon is ".getAmount($coupon->min_order_amount).' '.$general->cur_text]]);
        }

        if($couponUser->count() >= $coupon->usage_per_user){
            return response()->json(['coupon'=>['Sorry! Your Coupon limit has been reached']]);
        } else {
            $couponUser = new CouponUser();
            $couponUser->user_id = auth()->id();
            $couponUser->coupon_id = $coupon->id;
            $couponUser->save();
        }

        if($coupon->course_id == 0){
            if($coupon->amount_type == 2){
                $newPrice = $price - $coupon->coupon_amount;
                
            } else{
                $discount = $price*($coupon->coupon_amount/100);
                $newPrice = $price - $discount;
            }
            session()->put('newPrice',$newPrice);
            session()->put('coupon', $coupon->coupon_code);
            return response()->json(['yes'=>"Coupon applied! new price is $newPrice".$general->cur_text,'newPrice'=>"$newPrice".' '.$general->cur_text]);
        } else {

            if($coupon->course_id != $course->id){
                return response()->json(['coupon'=>['Sorry! Coupon not valid for this course']]);

            } else {

                if($coupon->amount_type == 2){
                    $newPrice = $price - $coupon->coupon_amount;
                    
                } else{
                    $discount = $price*($coupon->coupon_amount/100);
                    $newPrice = $price - $discount;
                }
                session()->put('newPrice',$newPrice);
                session()->put('coupon', $coupon->coupon_code);
                return response()->json(['yes'=>"Coupon applied! new price is $newPrice".$general->cur_text,'newPrice'=>"$newPrice".' '.$general->cur_text]);
            }

        }


    }

    public function postComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'course_id' => 'required|numeric|gt:0'
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->course_id = $request->course_id;
        $comment->parent_id = $request->parent_id ?? null;
        $comment->comment = $request->comment;
        $comment->save();

        $notify[]=['success','Comment has been posted'];
        return back()->withNotify($notify);
    }


}
