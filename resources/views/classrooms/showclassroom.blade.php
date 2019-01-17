@extends('layouts.app')

@section('content')
    <a href="/classrooms" class="btn btn-default">Go Back</a>
    <h1>{{$classroom->name}}</h1>
    <div>
        {!!$classroom->description!!}
    </div>
    <div>
        {!!$classroom->place!!}
    </div>
    <a href="/classrooms/{{$classroom->id}}/edit" class="btn btn-default">Edit</a>


@endsection