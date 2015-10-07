<?php

namespace App\Events;

use App\Events\UlibierRegister;
use App\Ulibier;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Output\ConsoleOutput;

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
        $this->sendConfirmEmail($event->ulibier);
    }

    /**
     * Send an E-mail signup confirmation
     * @param Ulibier $user
     */
    public function sendConfirmEmail(Ulibier $user){
        Mail::send('emails.confirmation',['user'=>$user],function($m) use ($user){
            $m->from('noreply@ulibi.vn','Ulibi');
            $m->to($user->email,$user->firstname.' '.$user->lastname)
                ->subject('Ulibi sign-up confirmation');
        });
        $output=new ConsoleOutput();
        $output->writeln("<info>Message sent to $user->email :)</info>");
    }
}
