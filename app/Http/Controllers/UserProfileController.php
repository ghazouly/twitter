<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Tweet;
use Auth;

class UserProfileController extends Controller
{
    public function getAll(){

        $users = User::all();
        foreach ($users as $user) {

          // for following actions
          $me = Auth::user();
          $is_edit_profile = (Auth::id() == $user->id);
          $is_follow_button = !$is_edit_profile && !$me->isFollowing($user);

          // for getting latest counts
          $user->followersCount = User::where('id',$user->id)->with('userFollowers')->first()->userFollowers->count();
          $user->followingCount = User::where('id',$user->id)->with('userFollowings')->first()->userFollowings->count();
          $user->tweetsCount = User::where('id',$user->id)->with('tweet')->first()->tweet->count();

        }

    return view('layouts.user.index', [
                                      'users' => $users,
                                      'is_edit_profile' => $is_edit_profile,
                                      'is_follow_button' => $is_follow_button,
                                     ]);

    }

    public function getOne($username){

      $user = User::with(['tweet','like'])->where('username',$username)->firstOrFail();

      // for following actions
      $me = Auth::user();
      $is_edit_profile = (Auth::id() == $user->id);
      $is_follow_button = !$is_edit_profile && !$me->isFollowing($user);

      // for getting latest counts
      $user->followersCount = User::where('id',$user->id)->with('userFollowers')->first()->userFollowers->count();
      $user->followingCount = User::where('id',$user->id)->with('userFollowings')->first()->userFollowings->count();
      $user->tweetsCount = User::where('id',$user->id)->with('tweet')->first()->tweet->count();

      $tweets = Tweet::with(['user','like'])
                ->where('ownerUserId',$user->id)
                ->get();


      return view('layouts.user.show', [
                                        'user' => $user,
                                        'tweets' => $tweets,
                                        'is_edit_profile' => $is_edit_profile,
                                        'is_follow_button' => $is_follow_button,
                                       ]);
    }

  public function search(Request $request, User $users){
    //Algolia
    //$username = $request->input('username');
    //$users = User::search('$username');

      // Search for a user based on their name.
      if ($request->has('username')) {
          $username = $request->input('username');
          $users = DB::table('users')->where('username','LIKE', "%$username%" )->get();
      }

      return view('layouts.user.search', compact('users'));

  }

}
