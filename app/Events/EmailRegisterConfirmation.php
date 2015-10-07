<?php

namespace App\Events;

use App\Events\UlibierRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailRegisterConfirmation
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UlibierRegister  $event
     * @return void
     */
    public function handle(UlibierRegister $event)
    {
        //

    }
}
