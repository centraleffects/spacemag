<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Shop;

class ShopWorkerInvitation extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $shop, $current_user, $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Shop $shop, User $user, $current_user)
    {
        $this->user = $user;
        $this->shop = $shop;
        $this->current_user = $current_user;
        $this->subject = "Your account at ".$shop->name." has been created.";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.shop.worker-invitation');
    }
}
