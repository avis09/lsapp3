@extends('layouts.app')

@section('content')
    <h1>Add Rooms</h1>
    {!! Form::open(['action' => 'RoomsController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('venueName', 'Name')}}
        {{Form::text('venueName', '', ['class' => 'form-control', 'placeholder'
        => 'VenueName'])}}
    </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection