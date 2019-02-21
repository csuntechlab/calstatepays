<?php

namespace App\Services;

use App\Contracts\FeedBackContract;
use App\Mail\FeedBackMail;
use Illuminate\Support\Facades\Mail;

class FeedBackService implements FeedBackContract
{
    public $from_email;

    public function __construct()
    {
        $this->from_email = config('mail.from.address');
    }

    public function postFeedBack($request)
    {
//        $feedBack = new FeedBack;
//        $feedBack->email = $request->email;
//        $feedBack->body = $request->body;
//        $feedBack->save();

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
            'subject' => 'CalStatePays Feedback'
        ];
        Mail::to(config('mail.to_support'))->send(new FeedBackMail($emailItems));
    }
}
