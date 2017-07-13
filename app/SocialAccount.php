<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
  protected $fillable = ['user_id', 'social_network_user_id', 'social_network'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
