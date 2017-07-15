
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                      <h3>Registered Users:</h3>
                    </div>
                    <div class="col-md-6 col-md-offset-2"><br>
                      <!-- if there are creation errors, they will show here -->
                      {!! Html::ul($errors->all()) !!}
                      {!! Form::open(array('method' => 'GET','url' => '/home/user/search')) !!}
                          <div class="form-group">
                              {!! Form::text('username') !!}
                              {!! Form::submit('Search!', array('class' => 'btn btn-success')) !!}
                          </div>
                      {!! Form::close() !!}
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
