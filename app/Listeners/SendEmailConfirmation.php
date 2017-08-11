<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\Mail\Welcome;

class SendEmailConfirmation
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $mail = new Welcome($event->user);

        try {
            Mail::to($event->user->email)->send($mail);

        } catch (\Exception $e) {
            \Log::info('UserRegistered Mail Error', ['error' => "Wala na send ang email."]);
        }
    }
}
