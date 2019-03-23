@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder'
        => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{form::file('cover_image')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}

    {{--<div class="container">--}}
    {{--<h2>Passport Appointment System</h2><br/>--}}
    {{--<form method="post" action="{{url('add-sched')}}" enctype="multipart/form-data">--}}
    {{--@csrf--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4">--}}
    {{--<label for="Name">Name:</label>--}}
    {{--<input type="text" class="form-control" name="name">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4">--}}
    {{--<label for="Name">Name:</label>--}}
    {{--<input type="text" class="form-control" name="venue">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4">--}}
    {{--<label for="Name">Name:</label>--}}
    {{--<input type="text" class="form-control" name="timeS">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4">--}}
    {{--<label for="Name">Name:</label>--}}
    {{--<input type="text" class="form-control" name="timeE">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4">--}}
    {{--<label for="Name">Name:</label>--}}
    {{--<input type="text" class="form-control" name="comment">--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
    {{--<div class="col-md-4"></div>--}}
    {{--<div class="form-group col-md-4" style="margin-top:60px">--}}
    {{--<button type="submit" class="btn btn-success">Submit</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
@endsection