@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                      <h3>
                        @php
                        //get username beginning with '@'.
                        $username = '@'.$user->username;
                        @endphp
                          <b>{{ $user->name }}</b> (<a href="{{ URL::to('home/user/'.$user->username) }}">{{ $username }}</a>)
                          <br>
                      </h3>
                      <b>Tweets:</b> {{ $user->tweetsCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Following:</b> {{ $user->followingCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Followers:</b> {{ $user->followersCount }}
                  </div>

                  <div class="col-md-2 col-md-offset-3">
                    <br>
                    @if (Auth::check())
                        @if ($is_edit_profile)
                        <a href="#" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-success">Edit Profile</button>
                        </a>
                        @elseif ($is_follow_button)
                        <a href="{{ url('/follows/' . $user->username) }}" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-primary">Follow</button>
                        </a>
                        @else
                        <a href="{{ url('/unfollows/' . $user->username) }}" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-danger">Unfollow</button>
                        </a>
                        @endif
                    @endif
                  </div>
                </div>
              </div>
              <div class="panel-body">

                   @foreach($tweets as $tweet)
                      <h4>
                        @php
                          //get username beginning with '@'.
                          $username = '@'.$tweet->user->username;
                        @endphp
                        <b>{{ $tweet->name }}</b>
                        (<a href="{{ URL::to('home/user/'.$tweet->user->username) }}">{{ $username }}</a>) <br>
                      </h4>

                      <blockquote>
                        <p>
                          {{ $tweet->content }}
                        </p>
                      </blockquote>

                      <b>Likes:</b> {{ $tweet->like->count() }}  &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Published at:</b> {{$tweet->created_at}}

                        @if (Auth::id() == $tweet->ownerUserId)
                        <div class="form-group">

                        <!-- delete the tweet -->
                        {!! Form::open(
                                [ 'route' => ['tweet.destroy', $tweet->id],
                                  'method' => 'get' ]
                                  ) !!}
                        <div class="form-group">
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete?', array('class' => 'btn btn-warning')) }}
                        </div>
                        {{ Form::close() }}

  
                        <!-- check whether the tweet belongs to logged-in user -->
                        @if ($tweet->ownerUserId == Auth::id())
                        <a href="#" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-success">Edit Tweet</button>
                        </a>
                        <!-- as the tweet belongs to another user and not liked before we apply like here -->
                        @elseif ($tweet->like->where('likerId',Auth::id())->count() > 0)
                        <a href="{{ url('/unlikes/' . $tweet->id) }}" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-danger">Unlike</button>
                        </a>
                        <!-- as the tweet belongs to another user and liked before we apply unlike here -->
                        @else
                        <a href="{{ url('/likes/' . $tweet->id) }}" class="navbar-btn navbar-right">
                            <button type="button" class="btn btn-primary">Like</button>
                        </a>
                        @endif

                        <br>
                        </div>
                      @endif

                      <hr>
                    @endforeach

              </div>
          </div>
      </div>
  </div>
</div>
@endsection
