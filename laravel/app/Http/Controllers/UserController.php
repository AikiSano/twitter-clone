<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Tweet;

class UserController extends Controller 
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $users = User::get();
        
        return view('users.index', compact('users'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id, User $user, Tweet $tweet, Follower $follower )
    {   
        $user = User::find($id);
        $params = [
            'user' => $user,
        ];

        $timelines = $tweet->getUserTimeLine($user->id);
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);


        return view('users.show', $params , [
            'user'           => $user,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    // フォロー
    public function follow(User $user)
    {

        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {   
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    public function edit(User $user){
        return view('users.show',['user' => $user]);
    }

    public function tweetDetail($id, User $user, Tweet $tweet)
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
