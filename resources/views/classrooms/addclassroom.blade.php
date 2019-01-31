@extends('layouts.app')

@section('content')
    <h1>Add Classroom</h1>
    {!! Form::open(['action' => 'ClassroomsController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('RoomFloor', '', ['class' => 'form-control', 'placeholder'
        => 'Room Floor'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::text('RoomNumber', '', ['class' => 'form-control', 'placeholder'
        => 'Room Number'])}}
    </div>


    <label for="venues">Venues</label>
    <select class="form-control" name="venues" id="venues" data-parsley-required="true">
        @foreach ($venues as $venue)
            {
            <option value="{{ $venue->venueID }}">{{ $venue->venueName }}</option>
            }
        @endforeach
    </select>

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection