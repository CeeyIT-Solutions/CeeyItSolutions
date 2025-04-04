<?php

namespace App\Lib;

use Textmagic\Services\TextmagicRestClient;
use Twilio\Rest\Client;

class SendSms
{

	public function clickatell($to,$fromName,$message,$credentials)
	{
		$message = urlencode($message);
		@file_get_contents("https://platform.clickatell.com/messages/http/send?apiKey=$credentials->api_key&to=$to&content=$message");
	}

	public function infobip($to,$fromName,$message,$credentials){
		$message = urlencode($message);
		@file_get_contents("https://api.infobip.com/api/v3/sendsms/plain?user=$credentials->username&password=$credentials->password&sender=$fromName&SMSText=$message&GSM=$to&type=longSMS");
	}

	public function messageBird($to,$fromName,$message,$credentials){
		$MessageBird = new \MessageBird\Client($credentials->api_key);
	  	$Message = new \MessageBird\Objects\Message();
	  	$Message->originator = $fromName;
	  	$Message->recipients = array($to);
	  	$Message->body = $message;
	  	$MessageBird->messages->create($Message);
	}

	public function nexmo($to,$fromName,$message,$credentials){
		$basic  = new \Vonage\Client\Credentials\Basic($credentials->api_key, $credentials->api_secret);
		$client = new \Vonage\Client($basic);
		$response = $client->sms()->send(
		    new \Vonage\SMS\Message\SMS($to, $fromName, $message)
		);
		$message = $response->current();
	}

	public function smsBroadcast($to,$fromName,$message,$credentials){
		$message = urlencode($message);
		$response = @file_get_contents("https://api.smsbroadcast.com.au/api-adv.php?username=$credentials->username&password=$credentials->password&to=$to&from=$fromName&message=$message&ref=112233&maxsplit=5&delay=15");
	}

	public function twilio($to,$fromName,$message,$credentials){
		$account_sid = $credentials->account_sid;
		$auth_token = $credentials->auth_token;
		$twilio_number = $credentials->from;

		$client = new Client($account_sid, $auth_token);
		$client->messages->create(
		    '+'.$to,
		    array(
		        'from' => $twilio_number,
		        'body' => $message
		    )
		);
	}

	public function textMagic($to,$fromName,$message,$credentials){
		$client = new TextmagicRestClient($credentials->username, $credentials->apiv2_key);
	    $result = $client->messages->create(
	        array(
	            'text' => $message,
	            'phones' => $to
	        )
	    );
	}

}