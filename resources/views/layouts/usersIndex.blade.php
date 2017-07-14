
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                  Users Index:
              </div>
              <div class="panel-body">
                    @foreach($users as $user)
                      <?php
                        //get username beginning with '@'.
                        $username = '@'.$user->username;
                      ?>
                      <b>{{ $user->name }}</b> (<a href="">{{ $username }}</a>) &nbsp; &nbsp; &nbsp; &nbsp;
                      Following: {{ $user->followingCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      Followers: {{ $user->followersCount }} <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
