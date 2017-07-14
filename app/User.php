<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
      return $this->hasMany('App\Tweet', 'ownerUserId');
    }

    /**
    * A one to many reltipnship between the user and its follow action,
    * whether to follow another one or to be followed.
    */
    public function userFollow(){
      return $this->hasMany('App\UserFollow', 'followerId', 'followedId');
    }

    //A one to many reltipnship between the tweet and user(s) mentioned within it.
    public function tweetMention(){
      return $this->belongsTo('App\TweetMention', 'mentionedUserId');
    }


}
