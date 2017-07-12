<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailChangeRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $new_email, $user, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_email, $user, $token)
    {
        $this->new_email = $new_email;
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.change_request');
    }
}
