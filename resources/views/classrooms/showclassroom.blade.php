@extends('layouts.app')

@section('content')
    <a href="/classrooms" class="btn btn-default">Go Back</a>

    <div>
        {!!$classrooms->RoomFloor!!}
    </div>
    <h1>
        {!!$classrooms->RoomNumber!!}
    </h1>
    <div>
        {!!$classrooms->f_venues->venueName!!}
    </div>
    <a href="/classrooms/{{$classrooms->roomsID}}/edit" class="btn btn-default">Edit</a>


@endsection