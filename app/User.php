<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class User extends Authenticatable
{
    use AlgoliaEloquentTrait;

    public $algoliaSettings = [
        'searchableAttributes' => [
            'username',
        ]
    ];

    //User::reindex();
    //User::useSettings();

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

    //A one to many reltipnship between the tweet and its owner.
    public function tweet(){
      return $this->hasMany('App\Tweet', 'ownerUserId','id');
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'user_follows', 'followerId', 'followedId')->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return !is_null($this->following()->where('followedId', $user->id)->first());
    }
    /**
    * A one to many reltipnship between the user and its follow action,
    * whether to follow another one or to be followed.
    */
    public function userFollowings(){
      return $this->hasMany('App\UserFollow', 'followerId', 'id');
    }
    public function userFollowers(){
      return $this->hasMany('App\UserFollow', 'followedId', 'id');
    }

    //A one to many reltipnship between the tweet and user(s) mentioned within it.
    public function tweetMention(){
      return $this->belongsTo('App\TweetMention', 'mentionedUserId');
    }

}
