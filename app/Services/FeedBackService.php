<?php

namespace App\Services;

use App\Contracts\FeedBackContract;
use App\Mail\FeedbackMail;
use App\Models\FeedbackEmail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Mail;
use ReCaptcha\ReCaptcha;

class FeedBackService implements FeedBackContract
{
    public $from_email;

    public function __construct()
    {
        $this->from_email = config('mail.from.address');
    }

    public function postFeedBack($request)
    {
        $captchaCheck = $this->recaptchaCheck($request->captcha);
        $response = [
            'success' => $captchaCheck,
            'message' => 'There was an issue verifying that you are not a human.'
        ];
        if ($captchaCheck) {
            $result = $this->sendEmail($request);

            $feedBack = new FeedbackEmail();
            $feedBack->email = $request->email;
            $feedBack->body = $request->body;
            $feedBack->status = $result ? 'sent' : 'failed';
            $feedBack->save();

            $response['success'] = $result;
            $response['message'] = 'There was an issue sending the email.';
            if ($result) {
                $response['message'] ='Thanks for your feedback!';
            }
        }
        return response()->json($response);
    }

    private function sendEmail($request)
    {
        $emailItems = [
            'email' => $request->email,
            'body' => $request->body,
        ];

        Mail::to(config('support.recipients.feedback'))->send(new FeedbackMail($emailItems));

        if (empty(Mail::failures())) {
            return true;
        }
        return false;
    }

    /**
     * Verifies that a reCaptcha has been accepted.
     * You can use this return value in a validator,
     * especially if you would like to flash a message
     * upon failure to accept.
     *
     * @param $recaptchaResponse
     * @return bool
     */
    private function recaptchaCheck($recaptchaResponse)
    {
        if(empty($recaptchaResponse)) {
            return false;
        }
        $secret = config('app.re_cap_secret_key');
        $client = new Client();
        try {
            $response = $client->post(config('app.google_captcha_url'), [
                'form_params' => [
                    'secret' => $secret,
                    'response' => $recaptchaResponse
                ]
            ]);
            $status = json_decode($response->getBody(), true);
            return $status['success'];
        } catch (RequestException $e) {
            return false;
        }
    }
}
