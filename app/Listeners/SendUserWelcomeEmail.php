<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserWelcomeMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserWelcomeEmail
{


    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Mail::to($event->user)->send(new UserWelcomeMail($event->user));
    }
}
