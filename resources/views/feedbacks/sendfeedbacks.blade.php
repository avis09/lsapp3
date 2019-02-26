@extends('layouts.app')

@section('content')
    <h1>Send Feedback</h1>

    {!! Form::open(['action' => 'FeedbacksController@create', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        <label for="venues">Choose a Venue</label>
        <select class="form-control" name="venues" id="venues" data-parsley-required="true">
            @foreach ($venue as $venues)
                {
                <option value="{{ $venues->venueID }}{{$venues->venueName}}"></option>
                }
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {{Form::label('comment', 'Comment')}}
        {{Form::text('Comment', '', ['class ' => 'form-control', 'placeholder'
        => 'Comment'])}}
    </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection