@extends('layouts.dashboard-master')

@section('title')
    <title>Calendar | BROS </title>
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
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                        <label for="venue">Venue Type <span class="required">*</span></label>
                                        <select class="form-control required-input" name="venue_type" id="venue-type" data-parsley-required="true">
                                            <option value="" disabled selected>Select Venue Type </option>
                                            @foreach ($venueTypes as $venueType)
                                            {
                                            <option value="{{ $venueType->venueTypeID }}">{{ $venueType->venueTypeName }}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="venue">Venue <span class="required">*</span></label>
                                    <select class="form-control required-input" name="venue_name" id="venue-name" data-parsley-required="true">
                                        <option value="" selected disabled>Select Venue</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date <span class="required">*</span></label>
                                        <input type="date" class="form-control required-input" id="scheduled-date">
                                            {{-- {!! $errors->first('date', '<p class="alert alert-danger">:message</p>') !!} --}}
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-check-schedule" disabled>Check Schedule</button>
                                    </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                                <table id="table-schedules" class="table table-bordered table-md">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-schedules">
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

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
                $('.btn-check-schedule').prop('disabled', true);
                $('#scheduled-date').val('');
                $.ajax({
                    url: "{{url("/student/schedules/get-venuesofvenuetype")}}",
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

            $(document).on('change', '#scheduled-date', function () {
                if($(this).val() != ''){
                    $('.btn-check-schedule').prop('disabled', false);
                }
                else{
                    $('.btn-check-schedule').prop('disabled', true);
                }
            });

            $(document).on('change', '#venue-name', function () {
                $('#scheduled-date').val('');
            });

            $(document).on('click', '.btn-check-schedule', function () {
                if(validate.standard('.required-input') == 0){
                    var venueID = $('#venue-name').val();
                    var date = $('#scheduled-date').val();
                    var tbody = $('.tbody-schedules');
                    var html = "";
                    $.ajax({
                        type: 'POST',
                        url: "{{url("/student/show-schedules")}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: venueID,
                            date: date
                            },
                        success: function (data) {
                            for (var i = 0; i < data.length; i++) {
                                var status = (data[i].check == 1) ? "<span class='badge badge-status badge-danger'>Not Available</span>" : "<span class='badge badge-status badge-success'>Available</span>";
                                var schedule_date = (data[i].date === undefined) ? date : data[i].date;
                                html += '<tr><td>' + schedule_date + '</td>';
                                html +='<td>' + data[i].timeStartTime + '-' + data[i].timeEndTime + '</td>';
                                html +='<td>' + status + '</td><tr>';
                            }
                            // if(data.length == 0){
                            //     html += '<tr>No reservations</tr>';
                            // }
                            $(tbody).html(html);
                        },
                        error: function () {
                            console.log('error');
                        }
                    })
              }
            })
        });
    </script>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#calendar').addClass('active');
        });
    </script>
@endsection
