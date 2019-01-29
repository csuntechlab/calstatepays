<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedBackMail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $email;
    private $body;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $data, $sender, $subject)
    {
        $this->view = $view;
        $this->email = $data['email'];
        $this->body = $data['body'];
        $this->title = $subject;
    }

    /**
     * Build the message
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject($this->title)
                    ->view($this->view)
                    ->with([
                        'email' => $this->email,
                        'body' => $this->body
                    ]);     
    }
}
