<?php

namespace App\Events;

use App\Events\Event;
use App\Ulibier;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UlibierRegister extends Event
{
    use SerializesModels;

    public $ulibier;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ulibier $ulibier)
    {
        //
        $this->ulibier=$ulibier;
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
