<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $html;
    public  $appointmentId;
    protected $vendorId;
    public function __construct($appointmentId,$vendorId,$html)
    {
        Log::debug('Event');
        $this->html = $html;
        $this->appointmentId = $appointmentId;
        $this->vendorId = $vendorId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): string
    {
        return new PrivateChannel('user-chat.'.$this->vendorId);

    }
}
