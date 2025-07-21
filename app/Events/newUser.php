<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $newUser;
    public function __construct($user)
    {
        $this->newUser = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastAs(){
        return 'addNewUser';
    }
    
    public function broadcastOn()
    {
        return new Channel('newUser'); 
    }
}
