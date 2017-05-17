<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\TodoTask;

class TaskAssignment extends Mailable
{
    use Queueable, SerializesModels;

    public $username, $task, $current_user_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, TodoTask $task, $current_user_name)
    {
        $this->username = $username;
        $this->task = $task;
        $this->current_user_name = $current_user_name;
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
