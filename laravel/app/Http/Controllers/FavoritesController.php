<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    /**
     * ツイートいいね
     * @param $request $favorite
     * @return @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Favorite $favorite)
    {   
        $user = auth()->user();
        $tweetId = $request->tweet_id;
        $isFavorite = $favorite->isFavorite($user->id, $tweetId);

        if(!$isFavorite) {
            $favorite->storeFavorite($user->id, $tweetId);
            return back();
        }
        return back();
    }

    /**
     * ツイートいいね取り消す
     * @param $favorite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Favorite $favorite)
    {
        $userId = $favorite->user_id;
        $tweetId = $favorite->tweet_id;
        $favoriteId = $favorite->id;
        $isFavorite = $favorite->isFavorite($userId, $tweetId);
        if($isFavorite) {
            $favorite->destroyFavorite($favoriteId);
            return back();
        }
        return back();
    }
}
