@extends('layouts.app')

@section('content')
    <a href="/classrooms" class="btn btn-default">Go Back</a>
    <h1>{{$classroom->RoomFloor}}</h1>
    <div>
        {!!$classroom->RoomNumber!!}
    </div>
    <a href="/classrooms/{{$classroom->id}}/edit" class="btn btn-default">Edit</a>


@endsection