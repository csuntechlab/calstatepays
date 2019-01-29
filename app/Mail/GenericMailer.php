<?php

declare(strict_types=1);

namespace app\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $data;
    public $view;
    public $replyTo;
    
    /**
     * GenericMailer constructor.
     * @param String $view
     * @param array $data
     * @param String $subject
     * @param array $replyTo
     */
    public function __construct(String $view, array $data, String $subject, array $replyTo)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->data = $data;
        $this->replyTo($replyTo["address"],$replyTo["name"]);
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->from(config('mail.username'))
                    ->subject($this->subject)
                    ->view($this->view)
                    ->with($this->data);
    }
}