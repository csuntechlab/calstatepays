<?php

declare(strict_types=1);

namespace app\Mailer;

use App\Mail\FeedBackMail;
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
    public function sendToOne($view, array $data, $email, $subject)
    {
        return Mail::to($data['email'])->send(new FeedBackMail($view, $data, $email, $subject));
    }

}