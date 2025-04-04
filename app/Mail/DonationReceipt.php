<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;
use Carbon\Carbon;

class DonationReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->subject('Your Donation Receipt')
                    ->view('mail.donation_receipt')
                    ->with([
                        'name' => $this->donation->name,
                        'email' => $this->donation->email,
                        'amount' => $this->donation->amount,
                        'transaction_id' => $this->donation->transaction_id,
                        'donated_at' => Carbon::parse($this->donation->created_at)->format('F j, Y, g:i A'),
                        'foundation_name' => env('APP_NAME'),
                    ]);
    }
}
