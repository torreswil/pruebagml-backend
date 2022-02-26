<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class MailUsersReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@prueba-tecnica.com')
                    ->subject('Reporte Usuarios Registrados')
                    ->markdown('emails.usersReport',['reporte' => $this->report]);
    }
}
