@extends('layouts.dashboard-master')

@section('title')
    <title>Add Venue | GASD Bros </title>
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
                <h1><i class="fa fa-calendar"></i> Add Venue</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Add Venue</a></li>
            </ul>
        </div>
    </main>

    {!! Form::open(['action' => 'VenuesController@store2', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        <label for="venues">Building</label>
        <select class="form-control" name="buildingID" id="buildingID" data-parsley-required="true">
            @foreach ($venueB['building'] as $venueBs)
                {
                <option value="{{ $venueBs->buildingID }}">{{ $venueBs->buildingName  }}</option>
                }
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {{Form::label('venueName', 'Name')}}
        {{Form::text('venueName', '', ['class ' => 'form-control', 'placeholder'
        => 'VenueName'])}}
    </div>

    <label for="venues">Venue Floor</label>
    <select class="form-control" name="venueFloorID" id="venueFloorID" data-parsley-required="true">
        @foreach ($venueF['venuefloor'] as $venueFs)
            {
            <option value="{{ $venueFs->venueFloorID }}">{{ $venueFs->venueFloorName }}</option>
            }
        @endforeach
    </select>

    {{--<label for="venues">Venue Type</label>--}}
    {{--<select class="form-control" name="venueTypeID" id="venueTypeID" data-parsley-required="true">--}}
    {{--@foreach ($venueT['venuetype'] as $venueTs)--}}
    {{--{--}}
    {{--<option value="{{ $venueTs->venueTypeID }}">{{ $venueTs->venueTypeName }}</option>--}}
    {{--}--}}
    {{--@endforeach--}}
    {{--</select>--}}
    <label for="venues">Venue Status</label>
    <select class="form-control" name="venueStatus" id="venueStatus" data-parsley-required="true">
        @foreach ($venueST['venueStatus'] as $venueSTs)
            {
            <option value="{{ $venueSTs->venueStatusID }}">{{ $venueSTs->venueStatusType }}</option>
            }
        @endforeach
    </select>


    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-gasdroomreserve').addClass('active');
        });
    </script>
@endsection
