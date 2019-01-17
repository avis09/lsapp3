@extends('layouts.app')

@section('content')
    <h1>Add Classroom</h1>
    {!! Form::open(['action' => 'ClassroomsController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder'
        => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::text('description', '', ['class' => 'form-control', 'placeholder'
        => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('place', 'Place')}}
        {{Form::text('place', '', ['class' => 'form-control', 'placeholder'
        => 'Place'])}}
    </div>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection