<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\FeedBackContract;
use App\Http\Requests\FeedBackRequest;


class FeedBackController extends Controller
{
    protected $feedbackRetriever;

    public function __construct(FeedBackContract $feedBackContract)
    {
        $this->feedbackRetriever = $feedBackContract;
    }

    public function postFeedBack(FeedBackRequest $request)
    {
        return $this->feedbackRetriever->postFeedBack($request);
    }
}
