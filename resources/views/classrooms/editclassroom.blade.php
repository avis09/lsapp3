@extends('layouts.app')

@section('content')
    <h1>Edit Classroom</h1>
    {!! Form::open(['action' => ['ClassroomsController@update', $classrooms->roomsID],
     'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('RoomFloor', $classrooms->RoomFloor, ['class' => 'form-control', 'placeholder'
        => 'Room Floor'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('RoomNumber', $classrooms->RoomNumber, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Room Number'])}}
    </div>
    <label for="venues">Venues</label>
    <select class="form-control" name="venues" id="venues" data-parsley-required="true">
        <option value="{{ $classrooms->f_venues->venueID }}">{{ $classrooms->f_venues->venueName }}</option>
    </select>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection