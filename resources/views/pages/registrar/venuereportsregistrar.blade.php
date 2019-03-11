@extends('layouts.dashboard-master')

@section('title')
    <title>Room Reports | Registrar Bros </title>
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
                <h1><i class="fa fa-calendar"></i> Room Reports</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Room Reports</a></li>
            </ul>
        </div>
    </main>
    Total Number of Active Room: {{$count}}
    {{--<h1>Venues</h1>--}}
    {{--@if(count($venues) > 0)--}}
    {{--<div class="container">--}}
    {{--<table class="table">--}}

    {{--<tr>--}}
    {{--<td>Venue ID </td>--}}
    {{--<td>Building </td>--}}
    {{--</tr>--}}
    {{--@foreach($venues as $venue)--}}
    {{--<tr>--}}
    {{--<td>{{$venue->venueID}}</td>--}}
    {{--<td>{!!$venue->f_buildingV->buildingName!!}</td>--}}

    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--@else--}}
    {{--<p>No Venue Reports found</p>--}}
    {{--@endif--}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-venues').addClass('active');
        });
    </script>
@endsection
