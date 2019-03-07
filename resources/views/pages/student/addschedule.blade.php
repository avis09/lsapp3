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
                <h1><i class="fa fa-calendar-o"></i> Reservation </h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Reservation</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary btn-add-reservation mb-3">Add Reservation</button>
            <div class="table-responsive">
                        <table id="table-users" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID No. </th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Phone No. </th>
                                    <th>Role </th>
                                    <!-- <th>Department </th> -->
                                    <th>Status </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID No. </th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Phone No. </th>
                                    <th>Role </th>
                                    <!-- <th>Department </th> -->
                                    <th>Status </th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </main>
    

    <div class="modal fade" id="reservation-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-user-title" id="smallmodalLabel">Add New Account</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-user">
                    <div class="modal-body">

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
                                            {{-- <div class="col-lg-12 col-sm-12">
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
                                            </div> --}}
                                            {!! Form::close() !!}
                            
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-confirm">Confirm</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

@endsection


@section('scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-add-reservation', function () {

            $('#reservation-modal').modal('show');
        });
        $(document).on('change', function () {

            // console.log('changed');
            var venueID = $('#venue').val();
            var date = $('#date').val();
            // console.log(Floor_Id);
            var div = $('.sched');
            var op = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('findVenueSched') !!}',
                data: {'venueID': venueID, 'date': date},
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                        op += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';
                    }
                    if(data.length == 0){
                        op += '<option selected for="time" value="" disabled selected>No time available</option>';
                    }
                    $(div).html(" ");
                    $(div).append(op);
                },
                error: function () {
                    console.log('error');
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('change', function () {

            // console.log('changed');
            var venueID = $('#venue').val();
            var date = $('#date').val();
            // console.log(Floor_Id);
            var table = $('.availSched');
            var op = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('showSchedules') !!}',
                data: {'venueID': venueID, 'date': date},
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                        op += '<tr> + <td>' + data[i].date + '</td> + <td>' + data[i].timeStartTime + '-' + data[i].timeEndTime + '</td> + <td>' + data[i].statusName + '</td> + <td>' + data[i].firstName + '</td> + <tr>';
                    }
                    if(data.length == 0){
                        op += '<option selected for="time" value="" disabled selected>No reservations</option>';
                    }
                    $(table).html(" ");
                    $(table).append(op);
                },
                error: function () {
                    console.log('error');
                }
            })
        })
    });
</script>

@endsection

