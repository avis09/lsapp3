@extends('layouts.app')

@section('content') <div class="container">
    <h2>Passport Appointment System</h2><br/>
    <form method="POST" action="{{url('update')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="practiceID" value="{{$sched->practiceID}}">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{$sched->name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Name">venue:</label>
                <input type="text" class="form-control" name="venue" value="{{$sched->venue}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Name">timeEnd:</label>
                <input type="text" class="form-control" name="timeS" value="{{$sched->timeEnd}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Name">timeStart:</label>
                <input type="text" class="form-control" name="timeE" value="{{$sched->timeStart}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Name">comment:</label>
                <input type="text" class="form-control" name="comment" value="{{$sched->comment}}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
    {{--<h1>Edit Post</h1>--}}
    {{--{!! Form::open(['action' => ['PostsController@update', $post->id],--}}
     {{--'method' => 'POST']) !!}--}}
    {{--<div class="form-group">--}}
        {{--{{Form::label('title', 'Title')}}--}}
        {{--{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder'--}}
        {{--=> 'Title'])}}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--{{Form::label('body', 'Body')}}--}}
        {{--{{Form::textarea('body', $post->body, ['id' => 'article-ckeditor',--}}
        {{--'class' => 'form-control', 'placeholder'--}}
        {{--=> 'Body Text'])}}--}}
    {{--</div>--}}
    {{--{{Form::hidden('_method', 'PUT')}}--}}
    {{--{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}--}}
    {{--{!! ! Form::close() !!}--}}
@endsection