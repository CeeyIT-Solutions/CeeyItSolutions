<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaptopApplicationStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $status;
    public $remarks;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $status, $remarks = null)
    {
        $this->name = $name;
        $this->status = $status;
        $this->remarks = $remarks;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Laptop Application Status')
            ->view('mail.laptopapplication');
    }
}
