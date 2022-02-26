<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\MailUsersReport;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendReportToAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $report = User::selectRaw('count(*) usuarios, pais')->groupBy('pais')->getQuery()->get();

        Mail::to(config('app.email_admin'))->send(new MailUsersReport($report));

    }
}
