<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\TodoTask;

class TodoTaskAssignment extends Mailable
{
    use Queueable, SerializesModels;

    public $username, $task, $current_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, TodoTask $task, $current_user)
    {
        $this->username = $username;
        $this->task = $task;
        $this->current_user = $current_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.shop.todo.assign');
    }
}
