@extends('layouts.dashboard-master')

@section('title')
    <title>Reservation Requests | Registrar BROS</title>
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
        #textarea-reason{
            height: 100px;
            resize: none;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i>Reservation Requests</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Reservations</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pending-reservations-tab" data-toggle="tab" href="#pending-reservations-href" role="tab" aria-controls="pending-reservations-href" aria-selected="true">Pending Reservations</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="all-reservations-tab" data-toggle="tab" href="#all-reservations-href" role="tab" aria-controls="all-reservations-href" aria-selected="false">All Reservations</a>
  </li>
    <li class="nav-item">
        <a class="nav-link " id="archived-reservations-tab" data-toggle="tab" href="#archived-reservations-href" role="tab" aria-controls="archived-reservations-href" aria-selected="true">Archived Reservations</a>
    </li>
</ul>
<div class="tab-content mt-4" id="myTabContent">
  <div class="tab-pane fade show active" id="pending-reservations-href" role="tabpanel" aria-labelledby="pending-reservations-tab">
        <div class="table-responsive">
            <table id="table-pending" class="table table-striped w-100">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Purpose</th>
                    <th>Schedule Date</th>
                    <th>Time </th>
                    <th>Status </th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Purpose</th>
                    <th>Schedule Date</th>
                    <th>Time </th>
                    <th>Status </th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
  </div>
  <div class="tab-pane fade" id="all-reservations-href" role="tabpanel" aria-labelledby="all-reservations-tab">
      <div class="table-responsive">
            <table id="table-all" class="table table-striped w-100">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Purpose</th>
                        <th>Reason</th>
                        <th>Schedule Date</th>
                        <th>Time </th>
                        <th>Status </th>
                        <th>Date Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Room</th>
                        <th>Purpose</th>
                        <th>Reason</th>
                        <th>Schedule Date</th>
                        <th>Time </th>
                        <th>Status </th>
                        <th>Date Updated</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
        </div>
  </div>
    <div class="tab-pane fade" id="archived-reservations-href" role="tabpanel" aria-labelledby="archived-reservations-tab">
        <div class="table-responsive">
            <table id="table-archived" class="table table-striped w-100">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Purpose</th>
                    <th>Reason</th>
                    <th>Schedule Date</th>
                    <th>Time </th>
                    <th>Date Updated</th>
                    <th>Status </th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Purpose</th>
                    <th>Reason</th>
                    <th>Schedule Date</th>
                    <th>Time </th>
                    <th>Date Updated</th>
                    <th>Status </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
    {{--card body--}}
</div>
</div>
    </main>


        <div class="modal fade" id="reason-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title modal-venue-title" id="smallmodalLabel">Reason for Cancellation</span>
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
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary btn-cancel-reason" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-confirm-reason">Confirm</button>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var pending, all_schedules, archived;
        $(document).ready(function () {
            $('#menu-regroomreservation').addClass('is-expanded');
            $('#menu-regreservereqs').addClass('active');
            pending = $('#table-pending').DataTable({
                ajax: {
                    url: "/registrar/schedules/get-pending",
                    dataSrc: ''
                },
                responsive: true,
                "order": [[ 3, "desc" ]],
                columns: [
                    {
                        data: null,
                        render: function (data) {
                            return data.user.firstName + ' ' + data.user.lastName;

                        }
                    },
                    {data: 'f_venue.venueName'},
                    {data: 'purpose'},
                    {data: 'date'},
                    {
                        data: null,
                        render: function (data) {
                            return data.f_time.timeStartTime + ' - ' + data.f_time.timeEndTime;

                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            var status = data.reservation_status.statusName;
                            return "<span class='badge badge-status badge-" + status.toLowerCase() + "'>" + status + "</span>";
                        }
                    },
                    {data: 'created_at'},
                    { data: null,
                        render:function(data){
                            return '<button type="button" class="btn btn-primary btn-update-schedule btn-sm" data-type="2" data-id="'+data.scheduleID+'">Approve</button> '+
                                '<button type="button" class="btn btn-danger btn-update-schedule btn-sm" data-type="3" data-id="'+data.scheduleID+'">Reject</button>';
                    
                        }
                    }
                ]
            });
            
            all_schedules = $('#table-all').DataTable({
                ajax: {
                    url: "/registrar/schedules/get-all-reservations",
                    dataSrc: ''
                },
                responsive: true,
                "order": [[ 4, "desc" ]],
                columns: [
                    {
                        data: null,
                        render: function (data) {
                            return data.user.firstName + ' ' + data.user.lastName;

                        }
                    },
                    {data: 'f_venue.venueName'},
                    {data: 'purpose'},
                    { data: 'updatedMessage'},
                    {data: 'date'},
                    {
                        data: null,
                        render: function (data) {
                            return data.f_time.timeStartTime + ' - ' + data.f_time.timeEndTime;

                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            var status = data.reservation_status.statusName;
                            return "<span class='badge badge-status badge-" + status.toLowerCase() + "'>" + status + "</span>";
                        }
                    },
                    {data: 'updated_at'},
                    { data: null,
                        render:function(data){
                            if(data.reservation_status.statusID == 2){
                                return '<button type="button" class="btn btn-primary btn-update-schedule btn-sm" data-type="5" data-id="'+data.scheduleID+'">Done</button> <button type="button" class="btn btn-danger btn-update-schedule btn-sm" data-type="4" data-id="'+data.scheduleID+'">Cancel</button>';
                            }
                            else if(data.reservation_status.statusID == 3 || data.reservation_status.statusID == 4 || data.reservation_status.statusID == 5){
                                return '<button type="button" class="btn btn-secondary btn-update-schedule btn-sm" data-type="6" data-id="'+data.scheduleID+'">Archive</button>';
                            }
                    
                        }
                    }
                    // { defaultContent: ""}
                ]
            });

            archived = $('#table-archived').DataTable({
                ajax: {
                    url: "/registrar/schedules/get-archived",
                    dataSrc: ''
                },
                responsive:true,
                "order": [[ 6, "desc" ]],
                columns: [
                    { data: null,
                        render:function(data){
                            return data.user.firstName+' '+data.user.lastName;

                        }
                    },
                    { data: 'f_venue.venueName'},
                    { data: 'purpose'},
                    { data: 'updatedMessage'},
                    { data: 'date'},
                    { data: null,
                        render:function(data){
                            return data.f_time.timeStartTime+' - '+data.f_time.timeEndTime;

                        }
                    },
                    { data: 'updated_at'},
                    { data: null,
                        render: function(data){
                            var status = data.reservation_status.statusName;
                            return "<span class='badge badge-status badge-"+status.toLowerCase()+"'>"+status+"</span>";
                        }
                    }
                ]
            });

            $(document).on('click', '.btn-update-schedule', function (e) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                // if (type == 4 || type == 6) {
                    var status;
                    if(type == 2){
                        status = 'approve';
                    }
                    else if(type == 3){
                        status = 'reject';
                    }
                    else if(type == 5){
                        status = 'update';
                    }
                    else if(type == 4){
                        status = 'cancel';
                    }
                    else if(type == 6){
                        status = 'archive';
                    }
                    Swal.fire({
                        title: 'Confirmation',
                        text: "Are you sure you want to " + status + " this reservation?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            if(type == 4){
                                $('#reason-modal').modal('show');
                                $('#textarea-reason').removeClass('err_inputs');
                                $('.validate_error_message').remove();
                                $(document).on('click', '.btn-confirm-reason', function(){
                                    if(validate.standard('#textarea-reason') == 0){
                                        var reason = $('#textarea-reason').val();
                                        $.ajax({
                                            type: 'post',
                                            url: '/registrar/schedule/update-reservation-status',
                                            data: {
                                                _token: "{{csrf_token()}}",
                                                id: id,
                                                type: type,
                                                reason: reason
                                            },
                                            success: function (data) {
                                                if(type == 2 || type == 3){
                                                    pending.ajax.reload();
                                                }
                                                all_schedules.ajax.reload();
                                                archived.ajax.reload();
                                                Swal.fire(
                                                    data.title,
                                                    data.content_message,
                                                    data.type
                                                );
                                                $('#reason-modal').modal('hide');
                                            }
                                        });
                                    }
                                });
                            }
                            else{
                                $.ajax({
                                    type: 'post',
                                    url: '/registrar/schedule/update-reservation-status',
                                    data: {
                                        _token: "{{csrf_token()}}",
                                        id: id,
                                        type: type
                                    },
                                    success: function (data) {
                                        pending.ajax.reload();
                                        all_schedules.ajax.reload();
                                        archived.ajax.reload();
                                        Swal.fire(
                                            data.title,
                                            data.content_message,
                                            data.type
                                        );
                                    }
                                });
                            }
                        }
                    })
                // }
            });
        });
    </script>
@endsection