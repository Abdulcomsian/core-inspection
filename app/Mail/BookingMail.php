<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.booking')
            ->with([
                'appointment' => $this->appointment,
                'user' => $this->appointment->user,
                'serviceProvider' => $this->appointment->serviceProvider,
                'serviceDetails' => $this->appointment->serviceDetails,
            ])
            ->subject('New Appointment Booking');
    }
}
