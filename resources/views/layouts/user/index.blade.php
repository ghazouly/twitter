
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

                      <!-- simple search for users by username here -->
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
                      @php
                        //get username beginning with '@'.
                        $username = '@'.$user->username;
                      @endphp
                      <h4>
                        <b>{{ $user->name }}</b>
                        (<a href="{{ URL::to('home/user/'.$user->username) }}">
                          {{ $username }}</a>)
                      </h4>
                      <b>Tweets:</b> {{ $user->tweetsCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Following:</b> {{ $user->followingCount }} &nbsp; &nbsp; &nbsp; &nbsp;
                      <b>Followers:</b> {{ $user->followersCount }}

                      @php
                      // for following actions
                      $me = Auth::user();
                      $is_edit_profile = (Auth::id() == $user->id);
                      $is_follow_button = !$is_edit_profile && !$me->isFollowing($user);
                      @endphp

                      @if (Auth::check())
                          <!-- check whether that profile belongs to logged-in user -->
                          @if ($is_edit_profile)
                          <a href="#" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-success">Edit Profile</button>
                          </a>
                          <!-- as that profile belongs to another user and not followed before we apply follow here -->
                          @elseif ($is_follow_button)
                          <a href="{{ url('/follows/' . $user->username) }}" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-primary">Follow</button>
                          </a>
                          <!-- as that profile belongs to another user and followd before we apply unfollow here -->
                          @else
                          <a href="{{ url('/unfollows/' . $user->username) }}" class="navbar-btn navbar-right">
                              <button type="button" class="btn btn-danger">Unfollow</button>
                          </a>
                          @endif
                      @endif

                      <hr>
                    @endforeach



              </div>
          </div>
      </div>
  </div>
</div>
@endsection
