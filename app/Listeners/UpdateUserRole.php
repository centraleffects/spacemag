<?php

namespace App\Listeners;

use App\Events\CustomerBecameAClient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserRole
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
     * @param  CustomerBecameAClient  $event
     * @return void
     */
    public function handle(CustomerBecameAClient $event)
    {
        \Log::info('CustomerBecameAClient', ['user' => $event->user]);
    }
}
