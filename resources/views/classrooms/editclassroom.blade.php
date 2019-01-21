@extends('layouts.app')

@section('content')
    <h1>Edit Classroom</h1>
    {!! Form::open(['action' => ['ClassroomsController@update', $classroom->id],
     'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('RoomFloor', $classroom->RoomFloor, ['class' => 'form-control', 'placeholder'
        => 'Room Floor'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('RoomNumber', $classroom->RoomNumber, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Room Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('venueID', $classroom->venueID, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Venue'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection