<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetMention extends Model
{

  protected $table = 'tweet_mentions';

  //A one to many reltipnship between the tweet and user(s) mentioned within it.
  public function user(){
    return $this->hasMany('App\User', 'mentionedUserId');
  }

  //A one to many reltipnship between the tweet and user(s) mentioned within it.
  public function tweet(){
    return $this->belongsTo('App\Tweet', 'tweetId');
  }

}
