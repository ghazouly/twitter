
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h3>Registered Users:</h3>
              </div>
              <div class="panel-body">
                    @foreach($users as $user)
                      <?php
                        //get username beginning with '@'.
                        $username = '@'.$user->username;
                      ?>
                      <h4>
                      <b>{{ $user->name }}</b>
                      (<a href="{{ URL::to('home/user/'.$user->username) }}">{{ $username }}</a>)
                      </h4>
                      <b>Tweets:</b> {{ $user->tweetsCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Following:</b> {{ $user->followingCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Followers:</b> {{ $user->followersCount }}
                      <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
