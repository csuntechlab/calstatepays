<?php

declare(strict_types=1);

namespace app\Mailer;

use App\Mail\FeedBackMail;
use App\Mail\GenericMailer;
use Mail;

class Mailer
{
    /**
     * Send an email to one recipient processed in the request.
     *
     * @param mixed $view
     * @param array $data
     * @param mixed $email
     * @param mixed $subject
     */
    public function sentToOneCreateTicket($view, array $data, $email, $subject)
    {
        return Mail::to($data['email'])->send(new FeedBackMail($view, $data, $email, $subject));
    }

    public function sendToOneGeneric(String $view, Array $data, String $email, String $subject)
    {
        return Mail::to($data['email'])->send(new GenericMailer($view, $data, $email, $subject));
    }

}