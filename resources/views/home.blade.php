@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <?php
                      //get username beginning with '@'.
                      $username = '@'.Auth::user()->username;
                    ?>
                    Welcome <a href="#">{{$username}}</a>!

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
