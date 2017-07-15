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
              {!! Form::open(array('url' => '/home/tweet')) !!}
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
                        $username = '@'.$tweet->username;
                      ?>
                      <b>{{ $tweet->name }}</b> (<a href="{{ URL::to('home/user/'.$tweet->username) }}">{{ $username }}</a>) <br>
                    </h4>
                    <blockquote><p>
                      {{ $tweet->content }}
                    </p></blockquote>
                    <b>Likes:</b> {{ $tweet->likesCount }}  &nbsp; &nbsp; &nbsp; &nbsp; <b>Published at:</b>
                     {{$tweet->created_at}}
                      @if (Auth::id() == $tweet->ownerUserId)
                        <div class="form-group">
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
                    <hr>
                    @endforeach
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
