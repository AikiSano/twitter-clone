<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index($id, User $user, Tweet $tweet)
    {   
        $user = User::find($id);
        $params = [
            'user' => $user,
        ];

        $timelines = $tweet->getUserTimeLine($user->id);
        return view('users.tweetDetail', $params , [
            'user'           => $user,
            'timelines'      => $timelines,
        ]);
    }
}
