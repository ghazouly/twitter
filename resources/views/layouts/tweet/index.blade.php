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
                      <?php
                        $tweet = App\Tweet::where('id',$tweet->id)->firstOrFail();
                        $me = Auth::user();
                        $is_edit_tweet = (Auth::id() == $tweet->ownerUserId);
                        $is_like_button = !$is_edit_tweet && !$me->isLiking($tweet);

                      ?>

                      @if ($is_edit_tweet)
                      <a href="#" class="navbar-btn">
                          <button type="button" class="btn btn-success">Edit Tweet</button>
                      </a>
                      @elseif ($is_like_button)
                      <a href="{{ url('/likes/' . $tweet->id) }}" class="navbar-btn navbar-right">
                          <button type="button" class="btn btn-primary">Like</button>
                      </a>
                      @else
                      <a href="{{ url('/unlikes/' . $tweet->id) }}" class="navbar-btn navbar-right">
                          <button type="button" class="btn btn-danger">Unlike</button>
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
