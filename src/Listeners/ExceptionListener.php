<?php

namespace Bugger\Listeners;

use Bugger\Events\ExceptionEvent;
use Bugger\Mail\ExceptionMail;
use Illuminate\Support\Facades\Mail;

class ExceptionListener
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
     * @param  ExceptionEvent  $event
     * @return void
     */
    public function handle(ExceptionEvent $event)
    {
        $data = $event->data;
        $mail = new ExceptionMail($data);

        Mail::queue($mail);
    }
}
