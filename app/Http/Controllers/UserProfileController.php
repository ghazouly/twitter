<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class UserProfileController extends Controller
{
    public function getAll(){

        $users = DB::table('users')->select('users.*')->latest()->get();

    return view('layouts.user.index', compact('users'));
    }

/***
          foreach ($users as $user) {

            $user->followersCount = $users->where('users.id', '=','user_follows.followedId')
                                    ->get()
                                    ->count();
          }
          $user->followingCount = DB::select(
                                  DB::raw("SELECT COUNT(user_follows.followerId)
                                  FROM user_follows, users
                                  WHERE user_follows.followerId = users.id"));

      $users = DB::table('users')
      ->join('user_follows', 'followedId','=', 'users.id')
      ->select('user_follows.followedId', DB::raw('COUNT(*) as users.followersCount'))
      ->get();

      $users = DB::table('users')
      ->join('user_follows')
      ->select('users.*', 'user_follows.followedId', 'user_follows.followerId')
      ->get();

      DB::table('users')
          ->join('user_follows', 'followedId', 'followingId')
          ->select('*', DB::raw('COUNT(*) as review_count'))
          ->groupBy('user_id')
          ->having('review_count', '>' , 10)
          ->get();
          DB::table('users')
          ->join('user_follows', 'followedId', 'followingId')
          ->insert(DB::raw('users.followingCount := followingCount + x as users.followingCount'))
          ->get();

*/

    public function getOne($username){

      $userTemp = DB::table('users')
      ->where('username',$username)
      ->get();

      $user = $userTemp[0];

      $tweets = DB::table('tweets')
            ->join('users', 'tweets.ownerUserId', '=', 'users.id')
            ->select('tweets.*', 'users.name', 'users.username')
            ->where('tweets.ownerUserId', '=', $user->id)
            ->get();

      return view('layouts.user.show', compact('user', 'tweets'));

    }

}
