@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Timeline Tweets:
              </div>
              <div class="panel-body">
                    @foreach($tweets as $tweet)
                      <?php
                        //get username beginning with '@'.
                        $username = '@'.$tweet->username;
                      ?>
                      <b>{{ $tweet->name }}</b> (<a href="">{{ $username }}</a>) <br>
                      {{ $tweet->content }} <br>
                      Likes: {{ $tweet->likesCount }}
                      <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
