@extends('layouts.app')

@section('content')
    <h1>Add Venue</h1>
    {!! Form::open(['action' => 'VenuesController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('venueName', 'Name')}}
        {{Form::text('venueName', '', ['class' => 'form-control', 'placeholder'
        => 'Venue Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('campus', 'Campus')}}
        {{Form::textarea('campus', '', ['id' => 'article-ckeditor',
        'class' => 'form-control', 'placeholder'
        => 'Campus'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection