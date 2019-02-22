@extends('layouts.app')

@section('content')
    <h1>Send Feedback</h1>

    {!! Form::open(['action' => 'FeedbackController@create', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        <label for="venues">Venue</label>
        <select class="form-control" name="venueID" id="venueID" data-parsley-required="true">
            @foreach ($venueFB['feedbacks'] as $venueFBs)
                {
                <option value="{{ $venueFBs->venueID }}"></option>
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