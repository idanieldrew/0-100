<?php

namespace App\Listeners;

use App\Events\ProductGenerated;
use App\Mail\ProductCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendProductNotification
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
    public function handle(ProductGenerated $event): void
    {
        /*$$user = User::query()
            ->where('email', event->admin_email)
            ->first();*/

        $mail = new ProductCreated([
            $event->name,
            $event->price
        ]);

//        Mail::to($user->email)->send($mail);
    }
}
