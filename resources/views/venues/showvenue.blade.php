@extends('layouts.app')

@section('content')
    <a href="/venues" class="btn btn-default">Go Back</a>
    <h1>{{$venue->name}}</h1>
    <div>
        {!!$venue->description!!}
    </div>
    <div>
        {!!$venue->place!!}
    </div>
        <a href="/venues/{{$venue->id}}/edit" class="btn btn-default">Edit</a>


@endsection