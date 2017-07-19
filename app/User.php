<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class User extends Authenticatable
{
/***
    use AlgoliaEloquentTrait;

    //Algolia search setup.
    public $algoliaSettings = [
        'searchableAttributes' => [
        'username',
        ]
    ];

    User::reindex();
    User::useSettings();
*/
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'followersCount','followingCount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tweet(){
      return $this->hasMany('App\Tweet', 'ownerUserId','id');
    }

    public function like(){
      return $this->hasMany('App\UserLike','likerId', 'id');
    }

    public function userLikes(){
      return $this->belongsToMany('App\Tweet', 'user_likes','likerId', 'tweetId');
    }

    public function isLiking(Tweet $tweet)
    {
        return !is_null($this->userLikes()->where('likerId', $tweet->ownerUserId)->first());
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'user_follows', 'followerId', 'followedId')->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return !is_null($this->following()->where('followedId', $user->id)->first());
    }

    public function userFollowings(){
      return $this->hasMany('App\UserFollow', 'followerId', 'id');
    }

    public function userFollowers(){
      return $this->hasMany('App\UserFollow', 'followedId', 'id');
    }

    public function tweetMention(){
      return $this->belongsTo('App\TweetMention', 'mentionedUserId');
    }

}
