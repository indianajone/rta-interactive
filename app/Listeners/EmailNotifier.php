<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNotifier
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function whenUserWasRegistered(UserWasRegistered $event)
    {
        $user = $event->user;
        $password = $event->password;
        
        $this->mailer->send('emails.register', compact('user', 'password'), function ($m) use ($user) {
            $m->to($user->getEmailForPasswordReset());
        });
    }
}
