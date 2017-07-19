<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use Auth;
class UserLikeController extends Controller
{
  public function likes($id){

    // Find the User. Redirect if the User doesn't exist
    $tweet = Tweet::where('id', $id)->firstOrFail();

    // Find logged in User
    $userId = Auth::id();
    $me = User::find($userId);
    $me->userLikes()->attach($tweet->id);
    return redirect()->back();

  }

  public function unlikes($id){

    // Find the User. Redirect if the User doesn't exist
    $tweet = Tweet::where('id', $id)->firstOrFail();

    // Find logged in User
    $userId = Auth::id();
    $me = User::find($userId);
    $me->userLikes()->detach($tweet->id);
    return redirect()->back();

  }

}
