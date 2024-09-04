<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorApprovalNotification extends Notification
{
    use Queueable;
    protected $userDetails;
    protected $approvalStatus;
    /**
     * Create a new notification instance.
     */
    public function __construct($userDetails, $approvalStatus)
    {
        $this->userDetails = $userDetails;
        $this->approvalStatus = $approvalStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if($this->approvalStatus == 'accept')
        {
            $message = "Your Account has been approved";
        }elseif($this->approvalStatus == 'reject')
        {
            $message = "Your Account has been rejected";
        }
        return (new MailMessage)
                    ->greeting('Dear '.$this->userDetails['name'])
                    ->line($message)
                    // ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
