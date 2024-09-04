<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMessageUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $messageData;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $sender
     * @param  array  $messageData
     * @return void
     */
    public function __construct($sender, $messageData)
    {
        $this->sender = $sender;
        $this->messageData = $messageData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notify_message_user')
            ->with([
                'sender' => $this->sender,
                'messageData' => $this->messageData,
            ])
            ->subject('New Message Notification');
    }
}
