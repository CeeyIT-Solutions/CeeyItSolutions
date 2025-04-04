<?php

namespace App\Http\Controllers\Gateway\PaypalSdk;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Gateway\PaypalSdk\Core\PayPalHttpClient;
use App\Http\Controllers\Gateway\PaypalSdk\Core\ProductionEnvironment;
use App\Http\Controllers\Gateway\PaypalSdk\Core\SandboxEnvironment;
use App\Http\Controllers\Gateway\PaypalSdk\Orders\OrdersCaptureRequest;
use App\Http\Controllers\Gateway\PaypalSdk\Orders\OrdersCreateRequest;
use App\Http\Controllers\Gateway\PaypalSdk\PayPalHttp\HttpException;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use Illuminate\Http\Request;

class ProcessController extends Controller
{

    /*
     * Paypal Gateway
     */
    public static function process($deposit)
    {
        $paypalAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        // Creating an environment
        $clientId = $paypalAcc->clientId;
        $clientSecret = $paypalAcc->clientSecret;

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                             "intent" => "CAPTURE",
                             "purchase_units" => [[
                                 "reference_id" => "test_ref_id1",
                                 "amount" => [
                                     "value" => round($deposit->amount,2),
                                     "currency_code" => $deposit->method_currency
                                 ]
                             ]],
                             "application_context" => [
                                  "cancel_url" => route(gatewayRedirectUrl()),
                                  "return_url" => route('ipn.'.$deposit->gateway->alias)
                             ] 
                         ];

        try {
            $response = $client->execute($request);
            $send['redirect'] = true;
            $send['redirect_url'] = $response->result->links[1]->href;
        }catch (HttpException $ex) {
            $send['error'] = true;
            $send['message'] = 'Failed to Process';
        }

        return json_encode($send);
    }

    public function ipn()
    {
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest("APPROVED-ORDER-ID");
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

}
