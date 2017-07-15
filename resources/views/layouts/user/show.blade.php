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
                        <?php
                        //get username beginning with '@'.
                        $username = '@'.$user->username;
                        ?>
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
                      <?php
                        //get username beginning with '@'.
                        $username = '@'.$tweet->username;
                      ?>
                      <b>{{ $tweet->name }}</b> (<a href="{{ URL::to('home/user/'.$user->username) }}">{{ $username }}</a>) <br>
                      </h4>
                      <blockquote><p>
                      {{ $tweet->content }}
                      </p></blockquote>
                      <b>Likes:</b> {{ $tweet->likesCount }}  &nbsp; &nbsp; &nbsp; &nbsp;
                        <b>Published at:</b>
                        {{$tweet->created_at}}
                        @if (Auth::id() == $tweet->ownerUserId)

                        <div class="form-group">
                        <!-- delete the tweet -->
                        {!! Html::ul($errors->all()) !!}
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
                      <hr>
                    @endforeach

              </div>
          </div>
      </div>
  </div>
</div>
@endsection
