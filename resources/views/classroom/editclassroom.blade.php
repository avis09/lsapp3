@extends('layouts.app')

@section('content')
    <h1>Edit Classroom</h1>
    {!! Form::open(['action' => ['ClassroomsController@update', $classroom->id],
     'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $classroom->name, ['class' => 'form-control', 'placeholder'
        => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $classroom->description, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('place', 'Place')}}
        {{Form::textarea('place', $classroom->place, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Place'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection