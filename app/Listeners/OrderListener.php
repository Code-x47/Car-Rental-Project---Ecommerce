<?php

namespace App\Listeners;

use App\Mail\OrderMail;
use App\Events\OrderEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderListener
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
    public function handle(OrderEvent $event): void
    {
        Mail::to($event->email)->send(new OrderMail());
    }
}
