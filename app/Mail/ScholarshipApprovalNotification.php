<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScholarshipApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;
    private $applicationInfo, $pwd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pwd, $applicationInfo)
    {
        $this->applicationInfo = $applicationInfo;
        $this->pwd = $pwd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.scholarship_approval_notification')
            ->with([
                'applicationId' => $this->applicationInfo['application_id'],
                'fullName' => $this->applicationInfo['full_name'],
                'email' => $this->applicationInfo['email'],
                'course' => $this->applicationInfo['course']['title'],
                'password' => $this->pwd 
            ])
            ->subject('Scholarship Application Approved.');
    }
}
