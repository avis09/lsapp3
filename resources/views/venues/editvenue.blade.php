@extends('layouts.app')

@section('content')
    <h1>Edit Venue</h1>
    {!! Form::open(['action' => ['VenuesController@update', $venue->id],
     'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $venue->name, ['class' => 'form-control', 'placeholder'
        => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $venue->description, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('place', 'Place')}}
        {{Form::textarea('place', $venue->place, ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Place'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection