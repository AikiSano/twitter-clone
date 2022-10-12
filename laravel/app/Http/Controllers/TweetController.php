<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Tweet;
use Illuminate\Support\Facades\Validator;

class TweetController extends Controller
{
    public function index(Tweet $tweet, Follower $follower)
    {
        $user = auth()->user();
        $followIds = $follower->followingIds($user->id);
        // followed_idだけ抜き出す
        $followingIds = $followIds->pluck('followed_id')->toArray(); 
        $timelines = $tweet->getTimelines($user->id, $followingIds);
        return view('tweets.index', [
            'user'      => $user,
            'timelines' => $timelines
        ]);
    }

    public function show(Tweet $tweet)
    {
        $user = auth()->user();
        $tweet = $tweet->getTweet($tweet->id);
        return view('tweets.show',[
            'user'  => $user,
            'tweet' => $tweet,
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        return view('tweets.create', [
            'user' => $user
        ]);
    }

    public function store(Request $request, Tweet $tweet)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetStore($user->id, $data);

        return redirect('tweets');
    }
}
