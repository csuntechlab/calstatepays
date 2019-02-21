<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedBackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $email;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param String $view
     * @param array $data
     * @param String $subject
     */
    public function __construct(Array $data)
    {
        $this->email = $data['email'];
        $this->body = $data['body'];
        $this->title = $data['subject'];
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
                    ->view('emails.feedback');
    }
}
