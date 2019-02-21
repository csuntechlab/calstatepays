<?php

namespace App\Http\Controllers;

use App\Contracts\FeedBackContract;
use App\Http\Requests\FeedbackRequest;

class FeedBackController extends Controller
{
    protected $feedbackRetriever;

    public function __construct(FeedBackContract $feedBackContract)
    {
        $this->feedbackRetriever = $feedBackContract;
    }

    public function postFeedBack(FeedbackRequest $request)
    {
        return $this->feedbackRetriever->postFeedBack($request);
    }
}
