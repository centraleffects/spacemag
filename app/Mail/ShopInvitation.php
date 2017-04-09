<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Shop;

class ShopInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $shop;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Shop $shop, User $user)
    {

        $this->user = $user;
        $this->shop = $shop;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.shop.invitation');
    }
}
