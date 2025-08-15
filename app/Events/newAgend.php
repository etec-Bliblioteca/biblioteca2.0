<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newAgend
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newAgend;
    public function __construct($agd)
    {
        $this->newAgend = $agd;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastAs(){
        return 'addNewAgend';
    }
    
    public function broadcastOn()
    {
        return new Channel('newAgend'); 
    }
}
