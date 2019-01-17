@extends('layouts.app')

@section('content')
    <h1>Edit Venue</h1>
    {!! Form::open(['action' => ['VenuesController@update', $venue->id],
     'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('venueName', 'Name')}}
        {{Form::text('venueName', $venue->venueName, ['class' => 'form-control', 'placeholder'
        => 'VenueName'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection