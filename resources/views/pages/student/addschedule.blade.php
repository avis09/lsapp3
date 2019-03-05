@extends('layouts.dashboard-master')

@section('title')
    <title>Add Reservation | Bros</title>
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
                <h1><i class="fa fa-calendar-o"></i> Add Reservation </h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Active</a></li>
            </ul>
        </div>
    </main>
    <div class="container">
        <div class="panel-heading">Reservations
            <div class="panel-body">
                {!! Form::open(['action' => 'SchedulesController@store', 'method' => 'POST' ,
        'enctype' => 'multipart/form-data']) !!}
                {{csrf_field()}}
                {{--{!! Form::open(array('route' => 'schedules.addreservation','method'=>'POST','files'=>'true')) !!}--}}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @elseif (Session::has('warning'))
                            <div class="alert alert-danger">{{Session::get('warning')}}</div>
                        @endif
                    </div>

                    {{--<label for="venue">Venue Type:</label>--}}
                    {{--<select class="form-control" name="venuetype" id="venuetype" data-parsley-required="true">--}}
                    {{--@foreach ($scheduleVT['venuetype'] as $scheduleVTs)--}}
                    {{--{--}}
                    {{--<option value="{{ $scheduleVTs->venueTypeID }}">{{ $scheduleVTs->venueTypeName }}</option>--}}
                    {{--}--}}
                    {{--@endforeach--}}
                    {{--</select>--}}

                    <label for="venue">Venue:</label>
                    <select class="form-control" name="venue" id="venue" data-parsley-required="true">
                        @foreach ($venues as $venue)
                        {
                            <option value="{{ $venue->venueID }}">{{ $venue->venueName }}</option>
                        }
                        @endforeach
                        {{--@foreach ($scheduleV['venue'] as $scheduleVs)--}}
                            {{--{--}}
                            {{--{{ $scheduleVs->venueTypeID }}--}}
                            {{--}--}}
                        {{--@endforeach--}}

                    </select>


                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('purpose', 'Purpose:') !!}
                            <div class="">
                                {!! Form::text('purpose',null, ['class' => 'form-control']) !!}
                                {{--{!! $errors->first('dateAdded', '<p class=alert alert-danger>:message</p>') !!}--}}
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::label('date', 'Date:') !!}
                            <div class="">
                                {!! Form::date('date','', ['class' => 'form-control']) !!}
                                {!! $errors->first('date', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    {{--Time --}}

                    <break>
                        <label for="time">Time:</label>
                        <select class="form-control sched" name="time" id="time" data-parsley-required="true">
                            <option value=""></option>
                            {{--@foreach ($scheduleT['time'] as $scheduleTs){--}}
                            {{--@if($scheduleTs->venueTypeID == 1){--}}

                            {{--<option value="{{ $scheduleTs->timeID}}">{{ $scheduleTs->timeStartTime . ' - ' . $scheduleTs->timeEndTime}}</option>--}}
                            {{--}@elseif ($scheduleTs->venueTypeID == 2){--}}
                            {{--<option value="{{ $scheduleTs->timeID}}">{{ $scheduleTs->timeStartTime . ' - ' . $scheduleTs->timeEndTime}}</option>--}}
                            {{--}@endif--}}

                            {{--}@endforeach--}}
                        </select>
                        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                        {{--<div class="form-group">--}}
                        {{--{!! Form::label('timeTypeID', 'Time:') !!}--}}
                        {{--<div class="">--}}
                        {{--{!! Form::date('timeTypeID', null, ['class' => 'form-control']) !!}--}}
                        {{--{!! $errors->first('timeTypeID', '<p class="alert alert-danger">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>
                            {!! Form::submit('Schedule', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </break>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <table class="table table-bordered">
                        <thead>
                        <th>Venue:</th>

                        <th>Purpose:</th>
                        <th>Date:</th>
                        <th>Time:</th>


                        <th style="text-align:center"><a href="#" class="addRow"><i
                                        class="glyphicon glyphicon-plus"></i></a></th>
                        </thead>
                    </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
