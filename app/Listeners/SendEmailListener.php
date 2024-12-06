<?php

namespace App\Listeners;

use App\Mail\SendEmail;
use App\Event\SendEmailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailEvent $event): void
    {
        Mail::to($event->email)->send(new SendEmail($event->code));
    }
}
