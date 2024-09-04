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

class VendorEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $html;
    public  $appointmentId;
    protected $userId;
    /**
     * Create a new event instance.
     */
    public function __construct($appointmentId,$userId,$html)
    {
        Log::debug('Event');

        $this->html = $html;
        $this->appointmentId = $appointmentId;
        $this->userId = $userId;
        $this->html = $html;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): string
    {
        return new PrivateChannel('vendor-chat.'.$this->userId);

    }
}
