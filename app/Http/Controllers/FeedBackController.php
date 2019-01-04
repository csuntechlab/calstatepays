<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeedBackContract;

class FeedBackController extends Controller
{
    protected $feedbackRetriever;

    public function __construct(FeedBackContract $feedBackContract)
    {
        $this->feedbackRetriever = $feedBackContract;
    }

    public function postFeedBack()
    {
        return $this->feedbackRetriever->postFeedBack();
    }
}
