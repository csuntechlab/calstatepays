<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Contracts\FeedBackContract;
use App\Models\FeedBack;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedBackMail;
use App\Mailer\Mailer;

class FeedBackService implements FeedBackContract
{
    public $mailer;
    public $from_email;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->from_email = config('mail.from.address');
    }

    public function postFeedBack($request)
    {
        $feedBack = new FeedBack;
        $feedBack->email = $request->email;
        $feedBack->body = $request->body;
        $feedBack->save();

        $this->sendEmail($request);

        return response()->json([
            'success' => 'true',
            'message' => 'Thanks for your feed back!'
        ]);
    }

    private function sendEmail($request)
    {
        $emailItems = [
            'email' => $request->email,
            'body' => $request->body,
        ];

        $this->mailer->sentToOneCreateTicket('emails.feedback', $emailItems, $this->from_email, 'CalStatePays');
        return;
    }
}
