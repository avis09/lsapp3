@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="panel-heading">Reservations--}}
        {{--<div class="panel-body">--}}
            {{--{!! Form::open(['action' => 'SchedulesController@index', 'method' => 'POST' ,--}}
    {{--'enctype' => 'multipart/form-data']) !!}--}}
            {{--{!! Form::open(array('route' => 'schedules.addreservation','method'=>'POST','files'=>'true')) !!}--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                    {{--@if (Session::has('success'))--}}
                        {{--<div class="alert alert-success">{{Session::get('success')}}</div>--}}
                        {{--@elseif (Session::has('warning'))--}}
                    {{--<div class="alert alert-danger">{{Session::get('warning')}}</div>--}}
                        {{--@endif--}}
                {{--</div>--}}

                    {{--<div class="col-xs-4 col-sm-4 col-md-4">--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('scheduleID', 'Schedule:') !!}--}}
                            {{--<div class="">--}}
                                {{--{!! Form::text('scheduleID', null, ['class' => 'form-control']) !!}--}}
                                {{--{!! $errors->first('dateAdded', '<p class=alert alert-danger>:message</p>') !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('dateAdded', 'Start Date:') !!}--}}
                        {{--<div class="">--}}
                            {{--{!! Form::date('dateAdded', null, ['class' => 'form-control']) !!}--}}
                            {{--{!! $errors->first('dateAdded', '<p class="alert alert-danger">:message</p>') !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('timeTypeID', 'End Date:') !!}--}}
                        {{--<div class="">--}}
                            {{--{!! Form::date('timeTypeID', null, ['class' => 'form-control']) !!}--}}
                            {{--{!! $errors->first('timeTypeID', '<p class="alert alert-danger">:message</p>') !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;<br/>--}}
                {{--{!! Form::submit('Schedule', ['class' => 'btn btn-primary']) !!}--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    schedules
@endsection