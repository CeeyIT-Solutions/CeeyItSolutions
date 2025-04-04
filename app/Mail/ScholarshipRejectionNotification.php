<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScholarshipRejectionNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $applicationInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicationInfo)
    {
        $this->applicationInfo = $applicationInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.scholarship_rejection_notification')
            ->with([
                'applicationId' => $this->applicationInfo['application_id'],
                'fullName' => $this->applicationInfo['full_name'],
                'course' => $this->applicationInfo['course']['title'],
            ])
            ->subject('Scholarship Application Rejected.');
    }
}
