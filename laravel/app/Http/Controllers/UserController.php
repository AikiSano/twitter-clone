<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Models\Tweet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        $timeLines = $tweet->getUserTimeLine($user->id);
        $tweetCount = $tweet->getTweetCount($user->id);
        $followCount = $follower->getFollowCount($user->id);
        $followerCount = $follower->getFollowerCount($user->id);


        return view('users.show', $params , [
            'user'           => $user,
            'timelines'      => $timeLines,
            'tweet_count'    => $tweetCount,
            'follow_count'   => $followCount,
            'follower_count' => $followerCount
        ]);
    }

    // フォロー
    public function follow(User $user , $id)
    {
        $user = User::find($id); 
        $follower = auth()->user();
        // フォローしているか
        $isFollowing = $follower->isFollowing($user->id);
        if(!$isFollowing) {
        // フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user , $id)
    {   
        $user = User::find($id); 
        $follower = auth()->user();
        // フォローしているか
        $isFollowing = $follower->isFollowing($user->id);
        if($isFollowing) {
        // フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
        }
    }

    public function edit(User $user , $id){

        $user = User::find($id);
        return view('users.edit',['user' => $user]);
    }

    public function update(Request $request)
    {   
        // $user = new User();
        $user = auth()->user();        
        $data = $request->all();
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50',], 
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', ],
        ]);
        $validator->validate();
        $user->updateProfile($data);
        
        return redirect()->route('users.show' , $user->id);
    }
    
}
