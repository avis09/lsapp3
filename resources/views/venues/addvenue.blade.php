@extends('layouts.app')

@section('content')
    <h1>Add Venue</h1>

    {!! Form::open(['action' => 'VenuesController@store', 'method' => 'POST' ,
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

    <label for="venues">Venue Type</label>
    <select class="form-control" name="venueTypeID" id="venueTypeID" data-parsley-required="true">
        @foreach ($venueT['venuetype'] as $venueTs)
            {
            <option value="{{ $venueTs->venueTypeID }}">{{ $venueTs->venueTypeName }}</option>
            }
        @endforeach
    </select>
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