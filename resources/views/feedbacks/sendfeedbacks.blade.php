@extends('layouts.app')

@section('content')
    <h1>Send Feedback</h1>

    {!! Form::open(['action' => 'FeedbacksController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        <label for="venues">Choose Venue</label>
        <select class="form-control" name="f_venues" id="f_venue" data-parsley-required="true">
            @foreach ($f_venue as $f_venues)
                {
                <option value="{{ $f_venues->venueID }}"></option>
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