<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{

  protected $table = 'user_follows';

  /**
  * A one to many reltipnship between the user and its follow action,
  * whether to follow another one or to be followed.
  */
  public function userFollow(){
    return $this->belongsTo('App\User', 'followerId', 'followedId');
  }

}
