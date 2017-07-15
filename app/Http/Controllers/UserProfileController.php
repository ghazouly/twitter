<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;

class UserProfileController extends Controller
{
    public function getAll(){

        $users = DB::table('users')->select('users.*')->latest()->get();
        foreach ($users as $user) {

          // for getting latest counts
          $user->followersCount = User::where('id',$user->id)->with('userFollowers')->first()->userFollowers->count();
          $user->followingCount = User::where('id',$user->id)->with('userFollowings')->first()->userFollowings->count();
          $user->tweetsCount = User::where('id',$user->id)->with('tweet')->first()->tweet->count();

        }
    return view('layouts.user.index', compact('users'));
    }

    public function getOne($username){

      $user = User::where('username',$username)->firstOrFail();

      // for following actions
      $me = Auth::user();
      $is_edit_profile = (Auth::id() == $user->id);
      $is_follow_button = !$is_edit_profile && !$me->isFollowing($user);

      // for getting latest counts
      $user->followersCount = User::where('id',$user->id)->with('userFollowers')->first()->userFollowers->count();
      $user->followingCount = User::where('id',$user->id)->with('userFollowings')->first()->userFollowings->count();
      $user->tweetsCount = User::where('id',$user->id)->with('tweet')->first()->tweet->count();

      $tweets = DB::table('tweets')
            ->join('users', 'tweets.ownerUserId', '=', 'users.id')
            ->select('tweets.*', 'users.name', 'users.username')
            ->where('tweets.ownerUserId', '=', $user->id)
            ->get();

      return view('layouts.user.show', [
                                        'user' => $user,
                                        'tweets' => $tweets,
                                        'is_edit_profile' => $is_edit_profile,
                                        'is_follow_button' => $is_follow_button
                                       ]);
    }

  public function search(Request $request, User $user){

      // Search for a user based on their name.
      if ($request->has('username')) {
          $username = $request->input('username');
          $users = DB::table('users')->where('username','LIKE', "%$username%" )->get();
          return view('layouts.user.search', compact('users'));
      }
  }

}
