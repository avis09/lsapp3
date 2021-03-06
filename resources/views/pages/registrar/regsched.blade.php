@extends('layouts.dashboard-master')

@section('title')
    <title>Add Reservation | Registrar BROS</title>
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
                @if($settings->startDate < date("Y-m-d") && $settings->endDate > date("Y-m-d")) 
                    <button type="button" class="btn btn-primary btn-add-reservation mb-3">Add Reservation</button>
                @else
                    <div class="alert alert-danger">
                        Adding of new reservation is currently not available.
                    </div>
                @endif

                
                <div class="table-responsive">
                    <table id="table-reservations" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Venue Name </th>
                            <th>Type</th>
                            <th>Building</th>
                            <th>Scheduled Date</th>
                            <th>Time Reserved</th>
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
                            <th>Time Reserved</th>
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
                                <input type="text" name="purpose" id="purpose" class="form-control required-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Schedule Date <span class="required">*</span></label>
                            <input type="" name="date" id="schedule-date" class="form-control required-input" disabled>
                        </div>
                        <label for="time">Time <span class="required">*</span></label>
                        <div class="schedule-time-container">
                            <div class="input-group schedule-time-content1 mb-2">
                                <select class="form-control schedule-time required-input" name="time[]" id="schedule-time" data-parsley-required="true">
                                    <option value="" selected disabled>Select Time</option>
                                </select>
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger btn-delete-schedule-time" data-ctr="1"><i class="fas fa-trash-alt"></i></button>
                                </div>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title modal-user-title" id="smallmodalLabel">Waiver Form</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">Fill out the waiver form in order to make a court reservation.</div>
                    <h6>Enter all the user's name <span class="required">*</span></h6>
                    <div class="waiver-container">
                        @for($i=1;$i <= 2;$i++)
                            <div class="form-group input-group waiver-content{{$i}}">
                                <input type="text" name="waiver_name" class="form-control waiver waiver-name" id="waiver-name" placeholder="Name" data-ctr="{{$i}}">
                                <input type="text" name="waiver_id_number" class="form-control waiver waiver-id-number" id="waiver-id-number" data-type="id-number" placeholder="ID Number" data-ctr="{{$i}}">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger btn-delete-name" data-ctr="{{$i}}"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <button type="button" class="btn btn-primary btn-add-new-name">Add</button>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="checkbox-terms">
                        <label class="form-check-label" for="exampleCheck1">By checking this you agree to the <a href="#" target="_blank">Terms and Agreement</a> of the school</label>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-submit-waiver">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="waiver-with-data-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-user-title" id="smallmodalLabel">Waiver Form</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="table-waiver" class="table table-striped hidden">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-waiver">
                                        
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reason-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title modal-venue-title" id="smallmodalLabel">Reason</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Reason <span class="required">*</span></label> 
                                    <textarea class="form-control required-input" name="updatedMessage" id="textarea-reason"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer text-right reason-modal-footer">
                                <button type="button" class="btn btn-secondary btn-cancel-reason" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary btn-confirm-reason">Confirm</button>
                            </div>
                    </div>
                </div>
            </div>


@endsection


@section('scripts')
    <script>
        var reservations;
        var waiver_ctr = 2;
        var time_ctr = 1;
        var waiver_name = [];
        var waiver_id = [];
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
                html += '<div class="input-group schedule-time-content1 mb-2">';
                html += '<select class="form-control schedule-time required-input" name="time[]" id="schedule-time" data-parsley-required="true">';
                html += '<option value="" selected disabled>Select Time</option>';
                html += '</select>';
                html += '<div class="input-group-prepend">';
                html += '<button type="button" class="btn btn-danger btn-delete-schedule-time" data-ctr="1"><i class="fas fa-trash-alt"></i></button>';
                html += '</div></div>';
                $('.schedule-time-container').html(html);
                time_ctr = 1;
            }
        }

        $(document).ready(function () {
            $('#menu-regrreservation').addClass('is-expanded');
            $('#menu-regreserve').addClass('active');
            reservations = $('#table-reservations').DataTable({
                ajax: {
                    url: "{{url('registrar/schedules/get-user-reservations')}}",
                    dataSrc: ''
                },
                responsive:true,
                "order": [[ 5, "desc" ]],
                columns: [
                    { data: 'f_venue.venueName'},
                    { data: 'f_venue.f_venue_type_v.venueTypeName'},
                    { data: null,
                        render:function(data){
                            return data.f_venue.f_building_v.buildingName+' '+data.f_venue.floor.venueFloorName;

                        }
                    },

                    { data: 'date'},
                    { data: null,
                        render:function(data){
                            var startTime =  data.f_time.timeStartTime;
                            startTime = startTime.substring(0, startTime.indexOf(':', startTime.indexOf(':')+1));
                            var endTime = data.f_time.timeEndTime;
                            endTime = endTime.substring(0, endTime.indexOf(':', endTime.indexOf(':')+1));
                            return startTime+' - '+endTime;

                        }
                    },
                    { data: 'created_at',
                        render:function(data)  {
                            var date_time = new Date(data);
                            date_time = moment(date_time).format("YYYY-MM-DD HH:mm");
                            return date_time;
                        }
                    },
                    { data: 'updated_at',
                        render:function(data)  {
                            var date_time = new Date(data);
                            date_time = moment(date_time).format("YYYY-MM-DD HH:mm");
                            return date_time;
                        }
                    },
                    // { data: 'f_department.departmentName'},
                    { data: null,
                        render: function(data){
                            var status = data.reservation_status.statusName.toLowerCase();
                            return '<span class="badge badge-status badge-'+status+'">'+data.reservation_status.statusName+'</span>';
                        }
                    },
                    { data: null,
                        render:function(data){
                            var html = '';
                            if  (data.updatedMessage != "" && data.updatedMessage != null) {
                                html += '<button type="button" class="btn btn-danger btn-view-reason btn-sm" data-type="4" data-id="'+data.scheduleID+'">Reason</button>';
                            }
                            if (data.f_venue.venueTypeID ==  2) {
                                html += ' <button type="button" class="btn btn-info btn-view-waiver btn-sm" data-type="4" data-id="'+data.scheduleID+'">Waiver</button>';
                            }
                            
                            if(data.statusID == 1){
                                html += ' <button type="button" class="btn btn-danger btn-update-reservation-status btn-sm" data-type="4" data-user="'+data.userID+'" data-id="'+data.scheduleID+'">Cancel</button>';
                            }
                            else{
                                html += ' <button type="button" class="btn btn-secondary btn-update-reservation-status btn-sm" data-type="6" data-user="'+data.userID+'" data-id="'+data.scheduleID+'">Archive</button>';
                            }
                            return html;

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
                html += '<input type="text" name="waiver_name" class="form-control waiver waiver-name" id="waiver-name" placeholder="Name" data-ctr="'+waiver_ctr+'">';
                html += '<input type="text" name="waiver_id_number" class="form-control waiver waiver-id-number" id="waiver-id-number" data-type="id-number" placeholder="ID Number" data-ctr="'+waiver_ctr+'">';
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
                $('.btn-add-new-time').prop('disabled', false);
            });

            $(document).on('click', '.btn-view-reason', function(e){
                var sched_id = $(this).attr('data-id');
                $('#reason-modal').modal('show');
                $('#textarea-reason').prop('disabled', true);
                $('.reason-modal-footer').hide();
                $.ajax({
                    type: 'post',
                    url: "{{url('registrar/get-reason')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        sched_id: sched_id, 
                    },
                    success: function (data) {
                        $('#textarea-reason').val(data.updatedMessage);
                    }
                });
            });

            $(document).on('click', '.btn-view-waiver', function(){
                var id = $(this).attr('data-id');
                $('#waiver-with-data-modal').modal('show');
                $.ajax({
                    type: 'post',
                    url: "{{url('registrar/schedule/get-waiver')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id
                    },
                    success: function (data) {
                        var html = '';
                        $.each(data, function(x,y){
                            html += '<tr>';
                            html += '<td>'+y.studentName+'</td>';
                            html += '<td>'+y.studentIDnumber+'</td>';
                            html += '</tr>';
                        });
                        $('.tbody-waiver').html(html);
                        $('#table-waiver').show();
                    }
                });
            });


            $(document).on('click', '.btn-submit-waiver', function(e){
                if(validate.standard('.waiver') == 0){
                    if($('#checkbox-terms').prop('checked') == false){
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: 'Please indicate that you have read and agree to the Terms and Agreement of the school.',
                        });
                        return false;
                    }
                    var json = [];
                    var str = "";
                    $('.waiver-name').each(function(){
                        waiver_name.push($(this).val());
                        // if($(this).attr('data-type') == 'id-number'){
                        //    str +="id:"+$(this).val()+"}";
                        //     json.push(str);
                        // }
                        // else{
                        //     str ="{name:"+$(this).val()+",";
                        // }
                    });

                    $('.waiver-id-number').each(function(){
                        waiver_id.push($(this).val());
                    });

                    waiver_name = JSON.stringify(waiver_name);
                    waiver_id = JSON.stringify(waiver_id);

                    var time_arr = [];
                    $('.schedule-time').each(function(){
                        time_arr.push($(this).val());
                    });
                    time_arr = JSON.stringify(time_arr);
                    var form = $('#form-add-reservation').serialize()+'&waiver_name='+waiver_name+'&waiver_id='+waiver_id+'&times='+time_arr;
                    $.ajax({
                        url: "{{url('/registrar/schedules/create-reservation')}}",
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
                                            for(var i=1;i<=2;i++){
                                                html += '<div class="form-group input-group waiver-content'+i+'">';
                                                html += '<input type="text" name="waiver_name" class="form-control waiver waiver-name" id="waiver" data-ctr="'+i+'">';
                                                html += '<input type="text" name="waiver_id_number" class="form-control waiver waiver-id-number" id="waiver-id-number" data-type="id-number" placeholder="ID Number" data-ctr="'+i+'">';
                                                html += '<div class="input-group-prepend">';
                                                html += '<button type="button" class="btn btn-danger btn-delete-name" data-ctr="'+i+'"><i class="fas fa-trash-alt"></i></button>';
                                                html += '</div></div>';
                                            }
                                            $('.waiver-content').html(html);

                                            waiver_name = [];
                                            waiver_id = [];
                                            $('#checkbox-terms').prop('checked', false);
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
                if(validate.standard('#form-add-reservation .required-input') == 0){
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
                            url: "{{url('registrar/schedules/create-reservation')}}",
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
                var userID = ($(this).attr('data-user') !== undefined) ? $(this).attr('data-user') : 0;
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
                            if (type == 4) {
                                $('#reason-modal').modal('show');
                                $('.reason-modal-footer').show();
                                $('#textarea-reason').removeClass('err_inputs');
                                $('#textarea-reason').prop('disabled', false);
                                $('#textarea-reason').val("");
                                $('.validate_error_message').remove();
                                $(document).on('click', '.btn-confirm-reason', function(){
                                    if (validate.standard('#textarea-reason') == 0) {
                                        var reason = $('#textarea-reason').val();
                                        $.ajax({
                                            type: 'post',
                                            url: "{{url('registrar/schedule/update-reservation-status')}}",
                                            data: {
                                                _token: "{{csrf_token()}}",
                                                id: id, 
                                                userID: userID,
                                                type: type,
                                                reason: reason
                                            },
                                            success: function (data) {
                                                if (data.success === true) {
                                                    reservations.ajax.reload();
                                                    Swal.fire(
                                                        data.title,
                                                        data.content_message,
                                                        data.type
                                                    );
                                                } else  {
                                                    Swal.fire(
                                                        'Error',
                                                        data.message,
                                                        'error'
                                                    );
                                                }
                                                
                                                
                                                $('#reason-modal').modal('hide');
                                            }
                                        });
                                    }
                                    return false;
                                });
                            } else {
                                $.ajax({
                                    type: 'post',
                                    url: "{{url('registrar/schedule/update-reservation-status')}}",
                                    data: {
                                        _token: "{{csrf_token()}}",
                                        id: id,
                                        userID: userID,
                                        type: type
                                    },
                                    success: function (data) {
                                        if (data.success === true) {
                                            reservations.ajax.reload();
                                            Swal.fire(
                                                data.title,
                                                data.content_message,
                                                data.type
                                            );
                                        } else  {
                                            Swal.fire(
                                                'Error',
                                                data.message,
                                                'error'
                                            );
                                        }
                                    }
                                });
                                return false;
                            }
                        }
                    })
                }
            });


            $(document).on('click', '.btn-view-reservation', function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "get-specific-schedule",
                    type: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id
                    },
                    success:function(data){
                        $('#reservation-modal').modal('show');
                        $('#venue-type').val(data.f_venue.f_venue_type_v.venueTypeID);
                        $('#purpose').val(data.purpose);
                    }

                });

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
                    url: "get-venuesofvenuetype",
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
                // $('.btn-add-new-time').prop('disabled', true);
                $('.schedule-time').each(function(){
                    time_arr.push($(this).val());;
                });
                time_arr = JSON.stringify(time_arr);
                $.ajax({
                    // url: "https://isproj2b.benilde.edu.ph/BROS/get-new-available-time",
                    url  : "{{url('get-new-available-time')}}",
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
                            var startTime =  data[i].timeStartTime;
                            startTime = startTime.substring(0, startTime.indexOf(':', startTime.indexOf(':')+1));
                            var endTime = data[i].timeEndTime;
                            endTime = endTime.substring(0, endTime.indexOf(':', endTime.indexOf(':')+1));

                            html += '<option for="time" value="' +data[i].timeID+ '">'+ startTime + '-' + endTime +'</option>';
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
                            var startTime =  data[i].timeStartTime;
                            startTime = startTime.substring(0, startTime.indexOf(':', startTime.indexOf(':')+1));
                            var endTime = data[i].timeEndTime;
                            endTime = endTime.substring(0, endTime.indexOf(':', endTime.indexOf(':')+1));

                            html += '<option for="time" value="' +data[i].timeID+ '">'+ startTime + '-' + endTime +'</option>';
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