<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

	public function depositMethods()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        $notify[] = 'Payment Methods';
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'message'=>['error'=>$notify],
            'data'=>[
            	'methods'=>$gatewayCurrency,
            	'image_path'=>imagePath()['gateway']['path']
            ],
        ]);
    }

    public function depositInsert(Request $request){
    	$validator = Validator::make($request->all(),[
            'amount' => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency' => 'required',
        ]);

        if ($validator->fails()) {
        	return response()->json([
                'code'=>200,
                'status'=>'ok',
        		'message'=>['error'=>$validator->errors()->all()],
        	]);
        }

        $user = auth()->user();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = 'Invalid gateway';
            return response()->json([
                'code'=>200,
                'status'=>'ok',
        		'message'=>['error'=>$notify],
        	]);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = 'Please follow deposit limit';
            return response()->json([
                'code'=>200,
                'status'=>'ok',
        		'message'=>['error'=>$notify],
        	]);
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
        $data->try = 0;
        $data->status = 0;
        $data->save();

        $notify[] = 'Deposit Created';
        return response()->json([
            'code'=>202,
            'status'=>'created',
        	'message'=>['success'=>$notify],
        	'data'=>[
        		'deposit'=>$data
        	],
        ]);
    }

    public function depositConfirm(Request $request){
    	$validator = Validator::make($request->all(),[
            'transaction' => 'required',
        ]);

        if ($validator->fails()) {
        	return response()->json([
                'code'=>200,
                'status'=>'ok',
        		'message'=>['error'=>$validator->errors()->all()],
        	]);
        }
    	$deposit = Deposit::where('trx', $request->transaction)->where('status',0)->orderBy('id', 'DESC')->with('gateway')->first();
        if (!$deposit) {
            $notify[] = 'Deposit not found';
            return response()->json([
                'code'=>404,
                'status'=>'error',
                'message'=>['error'=>$notify],
            ]);
        }
    	$dirName = $deposit->gateway->alias;
        $new = substr(__NAMESPACE__,0,-4).'\\Gateway'. '\\' . $dirName . '\\ProcessController';
        $data = (array)json_decode($new::process($deposit));
        if (array_key_exists('view', $data)) {
        	unset($data['view']);
        }
        return response()->json([
            'code'=>200,
            'status'=>'ok',
        	'data'=>[
        		'gateway_data'=>$data
        	],
        ]);
    }

}