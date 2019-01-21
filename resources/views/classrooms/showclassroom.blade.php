@extends('layouts.app')

@section('content')
    <a href="/classrooms" class="btn btn-default">Go Back</a>
    <h1>{{$classrooms->RoomFloor}}</h1>
    <div>
        {!!$classrooms->RoomNumber!!}
    </div>
    <div>
        {!!$classrooms->venueID!!}
    </div>
    <div>
        {!!$classrooms->venueName!!}
    </div>
    <a href="/classrooms/{{$classrooms->id}}/edit" class="btn btn-default">Edit</a>


@endsection