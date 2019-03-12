@extends('layouts.dashboard-master')

@section('title')
    <title>Venues | GASD Bros </title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar"></i> Venue Reports</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Venue Reports</a></li>
            </ul>
        </div>
    </main>
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

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-gasdreservevenue').addClass('active');
        });
    </script>
@endsection
