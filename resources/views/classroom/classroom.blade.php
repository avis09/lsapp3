@extends('layouts.app')

@section('content')
    <h1>Add Classroom</h1>
    {!! Form::open(['action' => 'ClassroomsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder'
        => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '', ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('place', 'Place')}}
        {{Form::textarea('place', '', ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Place'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection