@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! Html::ul($errors->all()) !!}
                    {!! Form::open(array('url' => '/home/tweet/')) !!}
                        <div class="form-group">
                            {!! Form::textarea('content') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('TWEET!', array('class' => 'btn btn-primary')) !!}
                          </div>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
