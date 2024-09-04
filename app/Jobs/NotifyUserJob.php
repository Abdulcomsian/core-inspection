<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NotifyMessageUserMail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sender;
    protected $messageData;

    /**
     * Create a new job instance.
     *
     * @param User $sender
     * @param array $messageData
     * @return void
     */
    public function __construct($sender, $messageData)
    {
        $this->sender = $sender;
        $this->messageData = $messageData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipient = User::findOrFail($this->messageData['toUser']->id);
        Mail::to($recipient->email)->send(new NotifyMessageUserMail($this->sender, $this->messageData));
    }
}
