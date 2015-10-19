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
     * @param mixin $user
     */
    public function sendConfirmEmail($user){
        Mail::send('emails.confirmation',
            [
                'user'=>$user,
                'confirmationLink'=>url('/ulibier/activated?token='.base64_encode(serialize($user)))
            ]
            ,function($m) use ($user){
            $m->from('noreply@ulibi.vn','Ulibi');
            $m->to($user['email'],$user['firstname'].' '.$user['lastname'])
                ->subject('Ulibi sign-up confirmation');
        });
        $email=$user['email'];
        $output=new ConsoleOutput();
        $output->writeln(<<<ENDDOC
<info>Message sent to $email :)</info>
ENDDOC
);
    }
}
