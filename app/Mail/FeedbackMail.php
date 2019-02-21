<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(Array $data)
    {
        $this->email = $data['email'];
        $this->body = $data['body'];
    }

    /**
     * Build the message
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('support.senders.feedback.address'))
                    ->subject(config('support.titles.feedback'))
                    ->view('emails.feedback');
    }
}
