@extends('layouts.dashboard-master')

@section('title')
    <title>Calendar | Bros </title>
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
                <h1><i class="fa fa-calendar"></i> Calendar</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Calendar</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
                    <div class="container">
                    <div class="form-group">
                        <label for="venue">Venue Type <span class="required">*</span></label>
                        <select class="form-control required-input" name="venue_type" id="venue-type" data-parsley-required="true">
                            <option value="">Select Venue Type </option>
                            @foreach ($venueTypes as $venueType)
                            {
                            <option value="{{ $venueType->venueTypeID }}">{{ $venueType->venueTypeName }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="venue">Venue <span class="required">*</span></label>
                    <select class="form-control" name="venue_name" id="venue-name" data-parsley-required="true">
                        <option value="" selected disabled>Select Venue</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date <span class="required">*</span></label>
                        <input type="date" class="form-control required-input" id="date">
                            {{-- {!! $errors->first('date', '<p class="alert alert-danger">:message</p>') !!} --}}
                    </div>
                        <table id="table-schedules" class="table table-bordered">
                            <tr>
                                <td>Date</td>
                                <td>Time</td>
                                <td>Status</td>
                                <td>Reserved By</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

    </main>
    

@endsection

@section('scripts')
<script>
        $(document).ready(function () {
            $('#menu-reservation').addClass('is-expanded');
            $('#calendar').addClass('active');
            $(document).on('change', '#venue-type', function () {
                var id = $(this).val();
                $.ajax({
                    url: "/student/schedule/get-venuesofvenuetype",
                    type: "POST",
                    data:{
                        _token: "{{csrf_token()}}",
                        id:id
                    },
                    success:function(data){
                        var html = '';
                            html += '<option value="" selected disabled>Select Venue</option>';
                        $.each(data, function(x,y){
                            html += '<option value="'+y.venueID+'">'+y.venueName+'</option>';
                        });
                            $('#venue-name').html(html);
                    }
                });
            });

            $(document).on('change', '#date', function () {
    
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