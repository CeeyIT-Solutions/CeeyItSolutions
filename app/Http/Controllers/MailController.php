<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function sendTestEmail()
    {
        $data = [
            'name' => 'Coba',
            'email' => 'lordscoba2tm@gmail.com',
        ];

        try {
            Mail::to($data['email'])->send(new TestMail($data));
        } catch (\Exception $e) {
            Log::error('Mailgun Error: ' . $e->getMessage());

            dd($e);
            //     //    Log::error('Mailgun Error: ' . $e->getMessage());
        }

        return "Mail Sent Successfully!";
    }
}