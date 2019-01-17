@extends('layouts.app')

@section('content')
    <a href="/venues" class="btn btn-default">Go Back</a>
    <h1>{{$venue->venueName}}</h1>

        <a href="/venues/{{$venue->venueID}}/edit" class="btn btn-default">Edit</a>


@endsection