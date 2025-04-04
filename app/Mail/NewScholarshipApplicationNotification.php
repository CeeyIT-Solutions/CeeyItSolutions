<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewScholarshipApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $applicationData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicationData)
    {
        $this->applicationData = $applicationData;
    }

    // Build the message
    public function build()
    {
        return $this->view('mail.new_application_notification')
            ->with([
                'applicationId' => $this->applicationData['application_id'],
                'fullName' => $this->applicationData['full_name'],
                'email' => $this->applicationData['email'],
            ])
            ->subject('New Scholarship Application Recieved.');
    }
}
