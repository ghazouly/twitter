@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>What's happening?</h3>
            </div>
            <div class="panel-body">
              <div class="form-group">

              <!--  simple form to create/post tweet -->
              {!! Form::open(['route' => 'tweet.store']) !!}
                  <div class="form-group">
                      {!! Form::textarea('content') !!}
                      {!! Form::submit('Tweet!', array('class' => 'btn btn-primary')) !!}
                  </div>
              {!! Form::close() !!}

            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>News Feed:</h3>
              </div>
              <div class="panel-body">

                    @foreach($tweets as $tweet)
                    <h4>
                      @php
                        //get username beginning with '@'.
                        $username = '@'.$tweet->user->username;
                      @endphp

                      <b>{{ $tweet->user->name }}</b> (<a href="{{ URL::to('home/user/'.$tweet->user->username) }}">
                        {{ $username }}
                      </a>) <br>
                    </h4><br>

                      @php
                      // for following actions
                      $me = Auth::user();
                      $is_edit_profile = (Auth::id() == $tweet->user->id);
                      $is_follow_button = !$is_edit_profile && !$me->isFollowing($tweet->user);
                      @endphp

                      @if (Auth::check())
                          <!-- check whether that profile belongs to logged-in user -->
                          @if ($is_edit_profile)
                          <a href="#" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-success">Edit Profile</button>
                          </a>
                          <!-- as that profile belongs to another user and not followed before we apply follow here -->
                          @elseif ($is_follow_button)
                          <a href="{{ url('/follows/' . $tweet->user->username) }}" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-primary">Follow</button>
                          </a>
                          <!-- as that profile belongs to another user and followd before we apply unfollow here -->
                          @else
                          <a href="{{ url('/unfollows/' . $tweet->user->username) }}" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-danger">Unfollow</button>
                          </a>
                          @endif
                      @endif

                    <br>
                    <blockquote><p>
                      {{ $tweet->content }}
                    </p></blockquote>
                    <b>Likes:</b> {{ $tweet->like->count() }}  &nbsp; &nbsp; &nbsp; &nbsp;
                    <b>Published at:</b>
                     {{$tweet->created_at}}

                     <!-- check if the logged-in user owns this tweet -->
                      @if (Auth::id() == $tweet->ownerUserId)
                        <div class="navbar-btn">
                        <!-- delete the tweet using GET & _method-DELETE -->
                        {!! Form::open(
                                [ 'route' => ['tweet.destroy', $tweet->id],
                                  'method' => 'get' ]
                                  ) !!}
                        <div class="form-group">
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete?', array('class' => 'btn btn-warning')) }}
                        </div>
                        {{ Form::close() }}
                        </div>
                      @endif

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
                    <hr>
                    @endforeach

              </div>
          </div>
      </div>
  </div>
</div>
@endsection
