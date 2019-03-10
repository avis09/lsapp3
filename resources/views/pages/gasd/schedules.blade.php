@extends('layouts.dashboard-master')

@section('title')
    <title>Add Reservation | Bros</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/badge.css')}}">
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .waiver-content{
            display: none;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> Court schedules </h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Court Schedules</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary btn-add-reservation mb-3">Add Reservation</button>
                <div class="table-responsive">
                    <table id="table-schedules" class="table table-striped">
                        <thead>
                        <tr>
                            <th>User Name </th>
                            <th>Venue Name</th>
                            <th>Time </th>
                            <th>Status </th>
                            <th>Purpose</th>
                            <th>Registrar Message</th>
                            <th>Date </th>
                            <th>Created At </th>
                            <th>Updated At </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>User Name </th>
                            <th>Venue Name</th>
                            <th>Time </th>
                            <th>Status </th>
                            <th>Purpose</th>
                            <th>Registrar Message</th>
                            <th>Date </th>
                            <th>Created At </th>
                            <th>Updated At </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    {{--<div class="modal fade" id="reservation-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<span class="modal-title modal-user-title" id="smallmodalLabel">Add New Reservation</span>--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">×</span>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--<form class="form-reservation" id="form-add-reservation">--}}
    {{--@csrf--}}
    {{--<div class="modal-body">--}}
    {{--<div class="form-group">--}}
    {{--<label for="venue">Venue Type <span class="required">*</span></label>--}}
    {{--<select class="form-control required-input" name="venuetype" id="venue-type" data-parsley-required="true">--}}
    {{--<option value="">Select Venue Type </option>--}}
    {{--@foreach ($scheduleVenueType as $venueType)--}}
    {{--{--}}
    {{--<option value="{{ $venueType->venueTypeID }}">{{ $venueType->venueTypeName }}</option>--}}
    {{--}--}}
    {{--@endforeach--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label for="venue">Venue <span class="required">*</span></label>--}}
    {{--<select class="form-control required-input" name="venue" id="venue-name" data-parsley-required="true">--}}
    {{--<option value="" selected disabled>Select Venue</option>--}}

    {{--</select>--}}
    {{--</div>--}}


    {{--<div class="form-group">--}}
    {{--<label> Purpose <span class="required">*</span></label>--}}
    {{--<div class="">--}}
    {{--<input type="text" name="purpose" class="form-control required-input">--}}
    {{--<!-- {!! Form::text('purpose',null, ['class' => 'form-control']) !!}--}}
    {{--{!! $errors->first('dateAdded', '<p class=alert alert-danger>:message</p>') !!}--}}{{-- -->--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--<label> Date <span class="required">*</span></label>--}}
    {{--<div class="">--}}
    {{--<input type="date" name="date" id="schedule-date" class="form-control required-input">--}}
    {{--<!--  {!! Form::date('date','', ['class' => 'form-control']) !!}--}}
    {{--{!! $errors->first('date', '<p class="alert alert-danger">:message</p>') !!} -->--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--Time --}}

    {{--<div class="form-group">--}}
    {{--<label for="time">Time <span class="required">*</span></label>--}}
    {{--<select class="form-control schedule-time required-input" name="time" id="time" data-parsley-required="true">--}}
    {{--<option value="" selected disabled>Select Time</option>--}}
    {{--</select>--}}
    {{--</div>--}}

    {{--<div class="form-group waiver-content">--}}
    {{--<div class="alert alert-info">Please fill up the waiver form.</div>--}}
    {{--<label>Waiver <span class="required">*</span></label>--}}
    {{--<select class="form-control schedule-time required-input" name="time" id="time" data-parsley-required="true">--}}
    {{--<option value="" selected disabled>Select Time</option>--}}
    {{--</select>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--<div class="modal-footer text-right">--}}
    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
    {{--<button type="submit" class="btn btn-primary btn-confirm">Confirm</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection


@section('scripts')
    <script>
        var reservations;
        $(document).ready(function () {
            $('#menu-reservation').addClass('is-expanded');
            $('#reservation-list').addClass('active');
            reservations = $('#table-schedules').DataTable({
                ajax: {
                    url: "/gasd/schedules/get-pending",
                    dataSrc: ''
                },
                responsive:true,
                // "order": [[ 5, "desc" ]],
                columns: [
                    { data: null,
                        render:function(data){
                            return data.user.firstName+' '+data.user.lastName;

                        }
                    },
                    // { data: 'user.firstName'},
                    { data: 'f_venue.venueName'},
                    // { data: 'timeID'},
                    { data: null,
                        render:function(data){
                            return data.f_time.timeStartTime+' - '+data.f_time.timeEndTime;

                        }
                    },
                    { data: 'statusID'},
                    // { data: 'reservationStatus.statusName'},
                    { data: 'purpose'},
                    { data: 'updatedMessage'},
                    { data: 'date'},
                    { data: 'created_at'},
                    { data: 'updated_at'},
                    // { data: null,
                    //     render:function(data){
                    //         return '<button type="button" class="btn btn-primary btn-approve-schedule btn-sm" data-id="'+data.scheduleID+'">Approve</button> '+
                    //             '<button type="button" class="btn btn-secondary btn-decline-schedule btn-sm" data-id="'+data.scheduleID+'">Decline</button>';
                    //
                    //     }
                    // }
                    // { defaultContent: ""}
                ]
            });

            // $(document).on('click', '.btn-add-reservation', function () {
            //     $('#reservation-modal').modal('show');
            // });

            {{--$(document).on('submit', '#form-add-reservation', function () {--}}

            {{--if(validate.standard('.required-input') == 0){--}}
            {{--var form = $(this).serialize();--}}
            {{--$.ajax({--}}
            {{--url: "/student/schedules/create-reservation",--}}
            {{--type: "POST",--}}
            {{--data: {--}}
            {{--_token: "{{csrf_token()}}",--}}
            {{--form: form--}}
            {{--},--}}
            {{--success: function(data){--}}

            {{--}--}}
            {{--});--}}
            {{--}--}}
            {{--return false;--}}
            {{--});--}}

            $(document).on('click', '.btn-approve-schedule', function(e){
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                if(type == 4 || type == 6){
                    var status = (type == 4) ? 'cancel' : 'archive';
                    Swal.fire({
                        title: 'Confirmation',
                        text: "Are you sure you want to "+status+" this reservation?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                type: 'post',
                                url: '/student/schedule/update-reservation-status',
                                data: {
                                    _token: "{{csrf_token()}}",
                                    id: id,
                                    type: type
                                },
                                success: function(data) {
                                    reservations.ajax.reload();
                                    Swal.fire(
                                        data.title,
                                        data.content_message,
                                        data.type
                                    );
                                }
                            });
                        }
                    })
                }
            });

            {{--$(document).on('change', '#venue-type', function () {--}}
            {{--var id = $(this).val();--}}
            {{--$.ajax({--}}
            {{--url: "/student/schedule/get-venuesofvenuetype",--}}
            {{--type: "POST",--}}
            {{--data:{--}}
            {{--_token: "{{csrf_token()}}",--}}
            {{--id:id--}}
            {{--},--}}
            {{--success:function(data){--}}
            {{--var html = '';--}}
            {{--html += '<option value="" selected disabled>Select Venue</option>';--}}
            {{--$.each(data, function(x,y){--}}
            {{--html += '<option value="'+y.venueID+'">'+y.venueName+'</option>';--}}
            {{--});--}}
            {{--$('#venue-name').html(html);--}}
            {{--}--}}
            {{--});--}}
            {{--});--}}

            {{--$(document).on('change', '#schedule-date', function () {--}}
            {{--var venueID = $('#venue-name').val();--}}
            {{--var date = $('#schedule-date').val();--}}
            {{--// console.log(Floor_Id);--}}
            {{--var div = $('.schedule-time');--}}
            {{--var op = "";--}}

            {{--$.ajax({--}}
            {{--type: 'POST',--}}
            {{--url: '{!! URL::to('findVenueSched') !!}',--}}
            {{--data: {--}}
            {{--_token: "{{csrf_token()}}",--}}
            {{--venueID: venueID,--}}
            {{--date: date--}}
            {{--},--}}
            {{--success: function (data) {--}}
            {{--if(data.length == 0){--}}
            {{--op += '<option selected for="time" value="" disabled selected>No time Available</option>';--}}
            {{--}--}}
            {{--else{--}}
            {{--op += '<option value="" selected disabled>Select Time</option>';--}}
            {{--}--}}
            {{--for (var i = 0; i < data.length; i++) {--}}
            {{--//op += '<option selected for="time" value="" disabled>Select a time now</option>';--}}
            {{--op += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';--}}
            {{--}--}}
            {{--$(div).html(" ");--}}
            {{--$(div).append(op);--}}
            {{--},--}}
            {{--error: function () {--}}
            {{--console.log('error');--}}
            {{--}--}}
            {{--})--}}
            {{--});--}}
            {{--$(document).on('change', '.schedule-time', function () {--}}
            {{--var venue_type = $('#venue-type').val();--}}
            {{--if(venue_type == 2){--}}
            {{--var html = "";--}}

            {{--}--}}
            {{--});--}}

        });
    </script>


@endsection

<!--
<script>
    $(document).ready(function () {
        $(document).on('change', function () {
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
</script> -->