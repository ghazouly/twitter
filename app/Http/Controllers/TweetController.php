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
use App\UserFollow;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //get users' followers ids in an array to be used in tweets listing.
      $followersIds = UserFollow::where('followerId', Auth::id())->pluck('followedId')->toArray();


      //list users' & whom follow tweets.
      $tweets = Tweet::with(['user','like'])
                ->whereIn('ownerUserId', $followersIds)
                ->orWhere('ownerUserId',Auth::id())
                ->get();

      return view('layouts.tweet.index', [
                                        'tweets' => $tweets,
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
    public function show()
    {
      //
    }


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
