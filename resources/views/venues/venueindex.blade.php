@extends('layouts.app')

@section('content')
    <h1>Venues</h1>
    @if(count($venues) > 0)
        @foreach($venues as $venue)
            <div class="well">
                <h3><a href="/venues/{{$venue->id}}">{{$venue->name}}</a></h3>
                <small><a href="/venues/{{$venue->description}}"></a></small>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif
@endsection