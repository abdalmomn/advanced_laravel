<?php

namespace App\Listeners;

use App\Events\newProductMail;
use App\Mail\productMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class sendProductMail
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
    public function handle(newProductMail $event): void
    {
        Mail::to(Auth::user()->email)->send(new productMailable($event->product));
    }
}
