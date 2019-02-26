@extends('layouts.app')

@section('content')
    <h1>Venues</h1>
    {{--@if(count($venues) > 0)--}}
        {{--@foreach($venues as $venue)--}}
            {{--<div class="well">--}}
                {{--<h3><a href="/venues/{{$venue->venueID}}">{{$venue->venueName}}</a></h3>--}}
                {{--<small><a href="/venues/{{$venue->campus}}">{{$venue->venueName}}</a></small>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--@else--}}
        {{--<p>No posts found</p>--}}
    {{--@endif--}}
    @if(count($venues) > 0)
    <div class="container">
        <table class="table">

            <tr>
                <td>Venue ID </td>
                <td>Building </td>
                <td>Venue Name </td>
                <td>Floor </td>
                <td>Venue Type </td>
                <td>Venue Status</td>
                <td>Added by User Type </td>
            </tr>
            @foreach($venues as $venue)
                <tr>
                    <td>{{$venue->venueID}}</td>
                    <td>{!!$venue->f_buildingV->buildingName!!}</td>
                    <td>{{$venue->venueName}}</td>
                    <td>{{$venue->venueFloorID}}</td>
                    <td>{!!$venue->f_venueTypeV->venueTypeName!!}</td>
                    <td>{!!$venue->f_venueStatusV->venueStatusType!!}</td>
                    <td>{!!$venue->userID!!}</td>
                    {{--<a href="/users/{{$user->userID}}/edit">EDIT</a>--}}
                    <td><a href=" {{ route('venues.edit',$venue->venueID) }}" class="btn btn-primary">Edit</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    @else
        <p>No Venue found</p>
    @endif
@endsection