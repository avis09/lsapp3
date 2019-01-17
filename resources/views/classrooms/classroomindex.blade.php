@extends('layouts.app')

@section('content')
    <h1>Classrooms</h1>
    @if(count($classrooms) > 0)
        @foreach($classrooms as $classroom)
            <div class="well">
                <h3><a href="/classrooms/{{$classroom->roomsID}}">{{$classroom->RoomFloor}}</a></h3>
                <small><a href="/classrooms/{{$classroom->RoomNumber}}"></a></small>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection