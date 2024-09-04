<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $approvalStatus;
    public $note;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $approvalStatus, $note)
    {
        $this->user = $user;
        $this->approvalStatus = $approvalStatus;
        $this->note = $note;
    }

    public function build()
    {
        $subject = $this->approvalStatus == 1 ? 'Account Approved' : 'Account Rejected';

        return $this->subject($subject)
            ->view('emails.approval_status');
    }
}
