<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

  protected $table = 'tweets';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'ownerUserId','content'
  ];

  //A one to many reltipnship between the tweet and user who owns it.
  public function user(){
    return $this->belongsTo('App\User', 'ownerUserId');
  }
  
  //A one to many reltipnship between the tweet and user who owns it.
  public function like(){
    return $this->hasMany('App\UserLike','tweetId', 'id');
  }

  //A one to many reltipnship between the tweet and user(s) mentioned within it.
  public function tweetMention(){
    return $this->hasMany('App\TweetMention', 'tweetId');
  }

}
