<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Collective\Html\HtmlFacade as Html;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use Session;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tweets = DB::table('tweets')
            ->join('users', 'ownerUserId', '=', 'users.id')
            ->select('tweets.*', 'users.name', 'users.username')
            ->latest()
            ->get();
            foreach ($tweets as $tweet) {
              $tweet = Tweet::where('id',$tweet->id)->firstOrFail();
              // for liking actions
              $me = Auth::user();
              $is_edit_tweet = (Auth::id() == $tweet->ownerUserId);
              $is_like_button = !$is_edit_tweet && !$me->isLiking($tweet);

            }
      //$tweets = DB::table('tweets')->get();

      return view('layouts.tweet.index', [
                                        'tweets' => $tweets,
                                        'is_edit_tweet' => $is_edit_tweet,
                                        'is_like_button'=> $is_like_button,
                                       ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Tweet $tweet)
    {
      return view('layouts.tweet.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate(request(), [
        'content' => 'required|max:140'
      ]);

      $tweet = new Tweet;

      if ($request->has('content')) {
          $tweet->content = $request->input('content');
          $tweet->ownerUserId = Auth::id();
      }
      $tweet->save();
      return redirect('/home/tweet');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet, $id)
    {

      $tweetTemp = DB::table('tweets')
            ->join('users', 'ownerUserId', '=', 'users.id')
            ->select('tweets.*', 'users.name', 'users.username')
            ->where('tweets.id',$id)
            ->get();

      $tweet = $tweetTemp[0];

      return view('layouts.tweet.show', compact('tweet'));

    }
/***
$user = DB::table('users')
      ->join('tweets', 'users.id', '=', 'tweets.ownerUserId')
      ->select('users.*', 'tweets.ownerUserId')
      ->where('users.id', '=', $tweet->ownerUserId)
      ->get();

return view('layouts.tweet.show', compact('tweet', 'user'));
      $tweet = DB::table('tweets')
        ->join('users', 'ownerUserId', '=', 'users.id')
        ->select('tweets.*', 'users.name', 'users.username')
        ->where('tweets.id',$id)
        ->get();

*/


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tweet = Tweet::find($id);
        $tweet->delete();

        Session::flash('message', 'tweet deleted successfully');
        return redirect()->back();
    }
}
