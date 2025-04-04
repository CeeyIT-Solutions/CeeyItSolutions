<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlackWorkspaceInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $inviteLink;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $inviteLink
     */
    public function __construct($name, $inviteLink)
    {
        $this->name = $name;
        $this->inviteLink = $inviteLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You’re Invited to Join Our Slack Workspace!')
            ->view('mail.slack_workspace_invite');
    }
}
