@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>
                  <?php
                  //get username beginning with '@'.
                  $username = '@'.$user->username;
                  ?>
                    <b>{{ $user->name }}</b> (<a href="{{ URL::to('home/user/'.$user->username) }}">{{ $username }}</a>)
                  <br>
                </h3>

                <b>Following:</b> {{ $user->followingCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                <b>Followers:</b> {{ $user->followersCount }}
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
                      <a href="{{ URL::to('home/tweet/'.$tweet->id) }}">
                      <blockquote><p>
                      {{ $tweet->content }}
                      </p></blockquote>
                      </a>
                      <b>Likes:</b> {{ $tweet->likesCount }}  &nbsp; &nbsp; &nbsp; &nbsp; <b>Published at:</b> {{$tweet->created_at}}
                      <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
