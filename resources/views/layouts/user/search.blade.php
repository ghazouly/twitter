@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                      <h3>Search Results:</h3>
                    </div>
                </div>
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
                      <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
