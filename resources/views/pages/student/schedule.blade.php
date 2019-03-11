@extends('layouts.dashboard-master')

@section('title')
    <title>Add Reservation | BROS</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/badge.css')}}">
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
                {{-- <p></p> --}}
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
                        <table id="table-reservations" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Venue Name </th>
                                    <th>Type</th>
                                    <th>Building</th>
                                    <th>Scheduled Date</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Venue Name </th>
                                    <th>Type</th>
                                    <th>Building</th>
                                    <th>Scheduled Date</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Status </th>
                                    <th>Action </th>
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
                        <span class="modal-title modal-user-title" id="smallmodalLabel">Add New Reservation</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-reservation" id="form-add-reservation">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="venue">Venue Type <span class="required">*</span></label>
                            <select class="form-control required-input" name="venue_type" id="venue-type" data-parsley-required="true">
                                <option value="">Select Venue Type </option>
                                @foreach ($scheduleVenueType as $venueType)
                                <option value="{{ $venueType->venueTypeID }}">{{ $venueType->venueTypeName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="venue">Venue <span class="required">*</span></label>
                            <select class="form-control required-input" name="venue" id="venue-name" data-parsley-required="true">
                                <option value="" selected disabled>Select Venue</option>
        
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Purpose <span class="required">*</span></label>
                            <div class="">
                                <input type="text" name="purpose" class="form-control required-input">
                            </div>
                        </div>
                        <div class="form-group">
                                    <label>Schedule Date <span class="required">*</span></label>
                                    <input type="" name="date" id="schedule-date" class="form-control required-input" disabled>
                        </div>
                        <label for="time">Time <span class="required">*</span></label>
                        <div class="schedule-time-container">
                            <div class="schedule-time-content1 mb-2">
                                <select class="form-control schedule-time required-input" name="time[]" id="schedule-time" data-parsley-required="true">
                                    <option value="" selected disabled>Select Time</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-add-new-time" disabled>Add</button>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-confirm">Confirm</button>
                    </div>
                </form>
                </div>
            </div>
            </div>


        <div class="modal fade" id="waiver-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-user-title" id="smallmodalLabel">Waiver Form</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="alert alert-warning">Fill out the waiver form in order to make a court reservation.</div>
                            <label class="control-label">Enter all the user's name <span class="required">*</span></label>
                            <div class="waiver-container">
                                @for($i=1;$i <= 5;$i++)
                                    <div class="form-group input-group waiver-content{{$i}}">
                                        <input type="text" name="waiver" class="form-control waiver" id="waiver" data-ctr="{{$i}}">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-danger btn-delete-name" data-ctr="{{$i}}"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <button type="button" class="btn btn-primary btn-add-new-name">Add</button>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-submit-waiver">Submit</button>
                    </div>
                </div>
            </div>
            </div>

@endsection


@section('scripts')
<script>
    var reservations;
    var waiver_ctr = 5;
    var time_ctr = 1;
    var waiver_data = [];
    var form, min_allowed_date, old_date;
    function getMinimumAllowedDate(id){
        var min = (id==2) ? 7 : 2;
        var today = new Date();
        var dd = today.getDate()+min;
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
                dd='0'+dd
            } 
        if(mm<10){
            mm='0'+mm
        } 
        min_allowed_date = yyyy+'-'+mm+'-'+dd;
    }

    function resetTimeSchedule(){
         var schedule_time = $('.schedule-time').val();
        if(schedule_time != ""){
            var html = "";
            html += '<div class="schedule-time-content1 mb-2">';
            html += '<select class="form-control schedule-time required-input" name="time[]" id="schedule-time" data-parsley-required="true">';
            html += '<option value="" selected disabled>Select Time</option>';
            html += '</select></div>';
            $('.schedule-time-container').html(html);
            time_ctr = 1;
        }

    }

    $(document).ready(function () {
                $('#menu-reservation').addClass('is-expanded');
                $('#reservation-list').addClass('active');
                reservations = $('#table-reservations').DataTable({
                ajax: {
                url: "/student/schedule/get-user-reservations",
                dataSrc: ''
                },
                responsive:true,
                    // "order": [[ 5, "desc" ]],
                columns: [
                // { data: 'userID'},
                { data: 'f_venue.venueName'},
                { data: 'f_venue.f_venue_type_v.venueTypeName'},
                { data: null,
                    render:function(data){
                        return data.f_venue.f_building_v.buildingName+' '+data.f_venue.floor.venueFloorName;

                    }
                },
                
                { data: 'date'},
                { data: 'created_at'},
                { data: 'updated_at'},
                // { data: 'f_department.departmentName'},
                { data: null,
                    render: function(data){
                        var status = data.reservation_status.statusName.toLowerCase();
                        return '<span class="badge badge-status badge-'+status+'">'+data.reservation_status.statusName+'</span>';
                    }
                },
                { data: null,
                    render:function(data){
                        if(data.statusID == 1){
                             return '<button type="button" class="btn btn-danger btn-update-reservation-status btn-sm" data-type="4" data-id="'+data.scheduleID+'">Cancel</button>';
                        }
                        else{
                             return '<button type="button" class="btn btn-secondary btn-update-reservation-status btn-sm" data-type="6" data-id="'+data.scheduleID+'">Archive</button>';   
                        }

                    }
                }
                ]
          });

        $(document).on('click', '.btn-add-reservation', function () {
            $('#reservation-modal').modal('show');
        });


        $(document).on('click', '.btn-add-new-name', function(e){
                waiver_ctr++;
                var html = '';
                html += '<div class="form-group input-group waiver-content'+waiver_ctr+'">';
                html += '<input type="text" name="waiver" class="form-control waiver" id="waiver" data-ctr="'+waiver_ctr+'">';
                html += '<div class="input-group-prepend">';
                html +=   '<button type="button" class="btn btn-danger btn-delete-name" data-ctr="'+waiver_ctr+'"><i class="fas fa-trash-alt"></i></button>';
                html +=   '</div></div>';
                $('.waiver-container').append(html);
        });

        $(document).on('click', '.btn-delete-name', function(e){
                var ctr = $(this).attr('data-ctr');
                $('.waiver-content'+ctr).remove();
        });

        $(document).on('click', '.btn-delete-schedule-time', function(e){
                var ctr = $(this).attr('data-ctr');
                $('.schedule-time-content'+ctr).remove();
        });

        $(document).on('click', '.btn-submit-waiver', function(e){
                if(validate.standard('.waiver') == 0){
                    $('.waiver').each(function(){
                        waiver_data.push($(this).val());
                    });
                    waiver_data = JSON.stringify(waiver_data);

                    var time_arr = [];
                    $('.schedule-time').each(function(){
                        time_arr.push($(this).val());
                    });
                    time_arr = JSON.stringify(time_arr);
                    var form = $('#form-add-reservation').serialize()+'&waiver_data='+waiver_data+'&times='+time_arr;
                    $.ajax({
                            url: "/student/schedules/create-reservation",
                            type: "POST",
                            data: form,
                            success: function(data){
                                if(data.success === true){
                                      Swal.fire({
                                            type: 'success',
                                            title: 'Success',
                                            text: data.message,
                                          })
                                      .then((result) => {
                                          if (result.value) {
                                            $('#waiver-modal').modal('hide');
                                            $('#reservation-modal').modal('hide');
                                            $('input[type="text"]').val('');
                                            $('input[type="date"]').val('');
                                            $('select').prop('selectedIndex', 0);
                                            $('#venue-name').children('option:not(:first)').remove();
                                            resetTimeSchedule();
                                              var html = "";
                                              for(var i=1;i<=5;i++){
                                                    html += '<div class="form-group input-group waiver-content'+i+'">';
                                                    html += '<input type="text" name="waiver" class="form-control waiver" id="waiver" data-ctr="{{$i}}">';
                                                    html += '<div class="input-group-prepend">';
                                                    html += '<button type="button" class="btn btn-danger btn-delete-name" data-ctr="{{$i}}"><i class="fas fa-trash-alt"></i></button>';
                                                    html += '</div></div>';
                                              }
                                             $('.waiver-content').html(html);

                                          }
                                        });
                                    reservations.ajax.reload();
                                    }
                                    else{
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Error',
                                            text: data.message,
                                          });
                                    }
                                
                            }
                    });
                }
        });

        $(document).on('submit', '#form-add-reservation', function () {
            if(validate.standard('.required-input') == 0){
                var venue_type = $('#venue-type').val();
                if(venue_type == 2){
                    $('#waiver-modal').modal('show');
                }
                else{
                    var time_arr = [];
                    $('.schedule-time').each(function(){
                        time_arr.push($(this).val());
                    });
                    time_arr = JSON.stringify(time_arr);
                    $.ajax({
                        url: "/student/schedules/create-reservation",
                        type: "POST",
                        data: $('#form-add-reservation').serialize()+"&times="+time_arr,
                        success: function(data){
                            if(data.success === true){
                              Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: data.message,
                                  })
                              .then((result) => {
                                  if (result.value) {
                                    $('#reservation-modal').modal('hide');
                                    $('input[type="text"]').val('');
                                    $('input[type="date"]').val('');
                                    $('select').prop('selectedIndex', 0);
                                    $('#venue-name').children('option:not(:first)').remove();
                                    resetTimeSchedule();
                                  }
                                });
                            reservations.ajax.reload();
                            }
                            else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: data.message,
                                  });
                            }
                        }
                    });
                }
            }
            return false;
        });

        $(document).on('click', '.btn-update-reservation-status', function(e){
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

        $(document).on('change', '#venue-type', function () {
            var id = $(this).val();
            
            $('#venue-name').html('<option selected>Loading . . .</option>');
            $('#schedule-date').prop('disabled', true);
            $('#schedule-date').attr('type', 'date');
            $('#schedule-date').val('');
             resetTimeSchedule();

             getMinimumAllowedDate(id);
            $('#schedule-date').attr('min', min_allowed_date);

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

        $(document).on('change', '.schedule-time', function () {
            $(this).prop('disabled', true);
            $('.btn-add-new-time').prop('disabled', false);
        });


        $(document).on('click', '.btn-add-new-time', function(e){
            time_ctr++;
            var time_arr = [];
            var id = $('#venue-name').val();
            var date = $('#schedule-date').val();
            $('.btn-add-new-time').prop('disabled', true);
            $('.schedule-time').each(function(){
                time_arr.push($(this).val());;
            });
                time_arr = JSON.stringify(time_arr);
            $.ajax({
                url: "/get-new-available-time",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    id: id,
                    date: date,
                    times: time_arr
                },
                success: function(data){
                    var html = '';
                    html += '<div class="input-group schedule-time-content'+time_ctr+' mb-2">';
                    html += '<select class="form-control schedule-time required-input" name="time[]" id="schedule-time" data-parsley-required="true">';
                    html += '<option value="" selected disabled>Select Time</option>';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';
                    }
                    html += '</select>';
                    html += '<div class="input-group-prepend">';
                    html +=   '<button type="button" class="btn btn-danger btn-delete-schedule-time" data-ctr="'+time_ctr+'"><i class="fas fa-trash-alt"></i></button>';
                    html +=   '</div></div>';
                    $('.schedule-time-container').append(html);
                }
            });  
        });



        $(document).on('change', '#venue-name', function(){
            resetTimeSchedule();
            $('#schedule-date').val('');
            $('#schedule-date').prop('disabled', false);
            var id = $('#venue-type').val();
            getMinimumAllowedDate(id);
            $('#schedule-date').attr('min', min_allowed_date);
        });

        $(document).on('change', '#schedule-date', function () {
            var venue_type = $('#venue-type').val();
            var venue_name = $('#venue-name').val();
            var schedule_date = $('#schedule-date').val();
            var div = $('.schedule-time');
            var html = "";
            var date = $(this).val();
            $('.schedule-time').html('<option selected>Loading . . .</option>');
            getMinimumAllowedDate(venue_type);
            if(schedule_date < min_allowed_date){
                $('#schedule-date').val(old_date);
                  html += '<option for="time" value="" disabled selected>Select Time</option>';
                  $(div).append(html);
                return false;
            }else{
                old_date = date;
            }

            $.ajax({
                type: 'POST',
                url: '/get-available-time',
                data: {
                    _token: "{{csrf_token()}}",
                    id: venue_name,
                    date: schedule_date
                 },
                success: function (data) {
                    if(data.length == 0){
                        html += '<option for="time" value="" disabled selected>No time Available</option>';
                    }
                    else{
                        html += '<option value="" selected disabled>Select Time</option>';
                    }
                    for (var i = 0; i < data.length; i++) {
                        html += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';
                    }
                    $(div).html(html);
                },
                error: function () {
                    console.log('error');
                }
            })
        });
    });
</script>


@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#reservation-list').addClass('active');
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
