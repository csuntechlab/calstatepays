<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Contracts\FeedBackContract;
use App\Models\FeedBack;

class FeedBackService implements FeedBackContract
{
    public function postFeedBack($request)
    {
        $feedBack = new FeedBack;
        $feedBack->email = $request->email;
        $feedBack->body = $request->body;
        $feedBack->save();

        return response()->json([
            'success' => 'true',
            'message' => 'Thanks for your feed back!'
        ]);
    }
}
