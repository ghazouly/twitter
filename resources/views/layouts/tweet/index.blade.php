@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h3>News Feed:</h3>
              </div>
              <div class="panel-body">
                    @foreach($tweets as $tweet)

                    <h4><?php
                        //get username beginning with '@'.
                        $username = '@'.$tweet->username;
                      ?>
                      <b>{{ $tweet->name }}</b> (<a href="{{ URL::to('home/user/'.$tweet->username) }}">{{ $username }}</a>) <br>
                    </h4>
                    <blockquote><p>
                      {{ $tweet->content }}
                    </p></blockquote>
                    <b>Likes:</b> {{ $tweet->likesCount }}  &nbsp; &nbsp; &nbsp; &nbsp; <b>Published at:</b>
                    <a href="{{ URL::to('home/tweet/'.$tweet->id) }}">
                     {{$tweet->created_at}}
                    </a>
                    <hr>

                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
