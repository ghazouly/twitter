@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                    @php
                      //get username beginning with '@'.
                      $username = '@'.Auth::user()->username;
                    @endphp

                    Welcome <a href="{{ URL::to('home/user/'.Auth::user()->username) }}">{{$username}}</a>!

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
