<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'screen_name',
        'name',
        'profile_image',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * フォローワーを取得できる
     * followerテーブルのfollowed_idとUserテーブルを紐付け（リレーション）
     * belongsToMany(使用するモデル,使用するテーブル名,リレーションを定義しているモデルの外部キー名,結合するモデルの外部キー名)
     */
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
    /**
     * フォローしているユーザを取得できる
     * followerテーブルのfollowing_idとUserテーブルを紐付け（リレーション）
     * belongsToMany(使用するモデル,使用するテーブル名,リレーションを定義しているモデルの外部キー名,結合するモデルの外部キー名)
     */
    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    /**
     * フォローする
     * @param int $user_id ユーザID
     * @return void
     */
    public function follow(Int $user_id) : void
    {
        $this->follows()->attach($user_id);
    }

    /**
     * フォロ-解除する
     * @param int $user_id ユーザID
     * @return void
     */
    public function unfollow(Int $user_id) : void
    {
        $this->follows()->detach($user_id);
    }

    /**
     * ユーザーがフォローしているか判定
     * where()でfollowed_idの中に、引数として渡された$userがいるかどうかを判定
     * @param int $user_id ユーザID
     * @return bool 
     */
    public function isFollowing(Int $user_id) : bool
    {
        return $this->follows()->where('followed_id', $user_id)->exists();
    }

    /**
     * ユーザーがフォローされているか判定
     * where()でfollowing_idの中に、引数として渡された$userがいるかどうかを判定
     * @param int $user_id ユーザID
     * @return bool 
     */
    public function isFollowed(Int $user_id) : bool
    {
        return $this->followers()->where('following_id', $user_id)->exists();
    }

    /**
     * ユーザのプロフィールを編集する
     * @param array $params
     * @return void
     */
    public function updateProfile(Array $params) : void
    {
        if (isset($params['profile_image'])) {
            $fileName = $params['profile_image']->store('public/profile_image/');
            $this->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'profile_image' => basename($fileName),
                    'email'         => $params['email'],
                ]);
        } else {
            $this->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'email'         => $params['email'],
                ]); 
        }
    }
}
