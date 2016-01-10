<?php

namespace App\Events;

use App\Events\Event;
use Ravarin\Entities\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasRegistered extends Event
{
    use SerializesModels;

    public $user;
    
    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;

        $this->password = $password;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
