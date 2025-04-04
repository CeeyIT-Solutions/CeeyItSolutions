<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Mail\VerifyEmail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm()
    {
        $pageTitle = "Forgot Password";
        return view(activeTemplate() . 'user.auth.passwords.email', compact('pageTitle'));
    }

    public function sendResetCodeEmail(Request $request)
    {
        if (filter_var($request->value, FILTER_VALIDATE_EMAIL)) {
            // The input is an email
            $validationRule = [
                'value' => 'required|email'
            ];
            $validationMessage = [
                'value.required' => 'Email field is required',
                'value.email' => 'Email must be a valid email'
            ];
            $column = 'email'; // Set the column to query
        } elseif (preg_match('/^\w+$/', $request->value)) { // Allows alphanumeric and underscores
            // The input is a username
            $validationRule = [
                'value' => 'required'
            ];
            $validationMessage = ['value.required' => 'Username field is required'];
            $column = 'username'; // Set the column to query
        } else {
            // Input is neither a valid email nor a valid username
            $notify[] = ['error', 'Invalid input provided'];
            return back()->withNotify($notify);
        }

        // Validate the request
        $request->validate($validationRule, $validationMessage);

        // Query the user based on the detected type
        $user = User::where($column, $request->value)->first();

        if (!$user) {
            $notify[] = ['error', 'User not found'];
            return back()->withNotify($notify);
        }


        PasswordReset::where('email', $user->email)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        // sendEmail($user, 'PASS_RESET_CODE', [
        //     'code' => $code,
        //     'operating_system' => @$userBrowserInfo['os_platform'],
        //     'browser' => @$userBrowserInfo['browser'],
        //     'ip' => @$userIpInfo['ip'],
        //     'time' => @$userIpInfo['time']
        // ]);
        $emailData = [
            'user' => $user,
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ];

        if (!empty($user->email)) {
            Mail::to($user->email)->send(new PasswordResetMail($emailData));

            $pageTitle = 'Account Recovery';
            $email = $user->email;
            session()->put('pass_res_mail', $email);
            $notify[] = ['success', 'Password reset email sent successfully'];
            return redirect()->route('user.password.code.verify')->withNotify($notify);
        }

        $pageTitle = 'Account Recovery';
        $email = $user->email;
        session()->put('pass_res_mail', $email);
        $notify[] = ['success', 'Please try again.'];
        return back()->withNotify($notify);
    }

    public function codeVerify()
    {
        $pageTitle = 'Account Recovery';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error', 'Oops! session expired'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        return view(activeTemplate() . 'user.auth.passwords.code_verify', compact('pageTitle', 'email'));
    }

    public function verifyCode(Request $request)
    {
        $code = trim($request->email_verified_code); 
        $passwordReset = PasswordReset::where('token', $code)->exists();
        
        if (!$passwordReset) {
            return back()->withNotify([['error', 'Invalid token']]); 
        }
        session()->put('token', $code);
        // Redirect to the password reset screen
        return redirect()->route('user.password.reset.screen')
            ->withNotify([['success', 'You can change your password now.']]);
    }
}
