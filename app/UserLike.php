<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{

  protected $table = 'user_likes';
  protected $fillable = [
      'likerId','tweetId'
  ];


  //A one to many reltipnship between the tweet and user who owns it.
  public function user(){
    return $this->belongsTo('App\User', 'likerId');
  }

  //A one to many reltipnship between the tweet and user who owns it.
  public function tweet(){
    return $this->belongsTo('App\User', 'tweetId');
  }

}
