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
              <!-- if there are creation errors, they will show here -->
              {!! Html::ul($errors->all()) !!}
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

                    <h4><?php
                        //get username beginning with '@'.
                        $username = '@'.$tweet->user->username;
                      ?>
                      <b>{{ $tweet->user->name }}</b> (<a href="{{ URL::to('home/user/'.$tweet->user->username) }}">{{ $username }}</a>) <br>
                    </h4>
                    <blockquote><p>
                      {{ $tweet->content }}
                    </p></blockquote>
                    <b>Likes:</b> {{ $tweet->like->count() }}  &nbsp; &nbsp; &nbsp; &nbsp; <b>Published at:</b>
                     {{$tweet->created_at}}
                      @if (Auth::id() == $tweet->ownerUserId)
                        <div class="navbar-btn">
                        <!-- delete the tweet  -->
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

                      @if ($tweet->ownerUserId == Auth::id())
                      <a href="#" class="navbar-btn navbar-right">
                          <button type="button" class="btn btn-success">Edit Tweet</button>
                      </a>
                      @elseif ($tweet->like->where('likerId',Auth::id())->count() > 0)
                      <a href="{{ url('/unlikes/' . $tweet->id) }}" class="navbar-btn navbar-right">
                          <button type="button" class="btn btn-danger">Unlike</button>
                      </a>
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
