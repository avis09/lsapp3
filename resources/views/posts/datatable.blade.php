@extends('layouts.dashboard-master')

@section('title')
    <title>Users | ITD Bros</title>
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
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="row">

        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary btn-add-user mb-3">Add </button>
                <div class="table-responsive">
                    <table id="table-users" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Venue </th>
                            <th>TimeStart </th>
                            <th>TimeEnd </th>
                            <th>Comment</th>
                            <th>actions</th>
                            <!-- <th>Department </th> -->
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td>Name</td>
                            <td>Venue</td>
                            <td>TimeStart</td>
                            <td>TimeEnd</td>
                            <td>Comment</td>
                            <td>ACtions</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </main>

    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title modal-user-title" id="smallmodalLabel">Add New Account</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-user">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label> Name <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input" name="name" id="name" a>
                                </div>
                                <div class="col-md-6">
                                    <label>Venue <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input" name="venue" id="venue">
                                </div>
                                <div class="col-md-6">
                                    <label>timeStart <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input" name="timeStart" id="timeStart">
                                </div>
                                <div class="col-md-6">
                                    <label>timeEnd <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input" name="timeEnd" id="timeEnd">
                                </div>
                                <div class="col-md-6">
                                    <label>comment <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input" name="comment" id="comment">
                                </div>
                            </div>
                        </div>
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
    <script type="text/javascript">
        var users;
        $(document).ready(function() {
            $('#menu-users').addClass('active');
            users = $('#table-users').DataTable({
                ajax: {
                    url: "/student/get-data",
                    dataSrc: ''
                },
                responsive:true,
                // "order": [[ 5, "desc" ]],
                columns: [
                    // { data: 'userID'},
                    { data: 'name'},
                    { data: 'venue'},
                    { data: 'timeStart'},
                    { data: 'timeEnd'},
                    { data: 'comment'},
                    // { data: 'actions'},
                    { data: null,
                        render:function(data){
                            return '<button type="button" class="btn btn-primary btn-edit-user btn-sm" data-id="'+data.practiceID+'">Edit</button> '+
                                '<button type="button" class="btn btn-secondary btn-archive-user btn-sm" data-id="'+data.practiceID+'">Archive</button>';

                        }
                    }
                    // { defaultContent: ""}
                ],
                //Start of data tables button
                dom:'B<"clear">lfrtip',
                "lengthMenu": [[10, 25, 50, 100, 300, 500, 700,1000,-1], [10, 25, 50,100, 300, 500,700,1000, "ALL"]],
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy" style="font-size:18px;"></i> <span style="font-size:12px;">Copy</span>',
                        titleAttr: 'Copy',
                        title: 'Copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel" style="font-size:18px;"></i> <span style="font-size:12px;">Excel</span>',
                        titleAttr: 'EXCEL',
                        title: 'EXCEL',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf" style="font-size:18px;"></i> <span style="font-size:12px;">PDF</span>',
                        titleAttr: 'PDF',
                        title: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" style="font-size:18px;"></i> <span style="font-size:12px;">Print</span>',
                        titleAttr: 'Print',
                        title: 'Sales Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-eye-slash" style="font-size:18px;"></i> <span style="font-size:12px;">Columns</span>',
                        titleAttr: 'Column Visibility',
                    }]
            });

            $(document).on('click', '.btn-add-user', function(e){
                e.preventDefault();
                //  $('#user-modal').remove('fade in');
                //   $('#user-modal').addClass('show');
                //   $('#user-modal').modal('show');
                $('.btn-reset-password').hide();
                $('input[type="text"]').val("");
                $('input[type="password"]').val("");
                $('input[type="email"]').val("");
                $('select').prop("selectedIndex", 0);
                $('.modal-user-title').html('Add New Account');
                $('.form-user').attr('id', 'form-add-user');
                $('#user-modal').modal('show');
                // $.ajax({
                //     url: "/student",
                //     type: 'GET',
                //     success:function(data){
                //         var response = JSON.parse(data);
                //         $('#password').val(response);
                //     }
                // })
            });
            $(document).on('click', '.btn-close',  function(){
                window.close();
            });

            $(document).on('submit', '#form-add-user', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "/student/store-data",
                    type: 'POST',
                    data: form,
                    success:function(data){
                        // var response = JSON.parse(data);
                        var action_type = 'create';
                        validateSaveUser(response,action_type);
                    }
                });
            });

            $(document).on('click', '.btn-edit-user', function(){
                var id = $(this).attr('data-id');
                $('.btn-confirm').attr('data-id',id);
                $('.btn-reset-password').show();
                $('.form-user').attr('id', 'form-edit-user');
                $('.modal-user-title').html('Edit Account');
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $.ajax({
                    url: "/itd/users/get-specific-userinfo",
                    type: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id
                    },
                    success:function(data){
                        if(response.userStatusID == 1){
                            var activeUsers = parseInt($('#activeUsers').html(), 10)+1;
                            $('#activeUsers').html(activeUsers);
                        } else if(response.userStatusID == 2) {
                            var inactiveUsers = parseInt($('#inactiveUsers').html(), 10)+1;
                            $('#inactiveUsers').html(inactiveUsers);
                        }
                        $('#user-modal').modal('show');
                        var response = JSON.parse(data);
                        $('.btn-reset-password').attr('data-id', response.IDnumber);
                        $('#firstName').val(response.firstName);
                        $('#lastName').val(response.lastName);
                        var phoneNumber = response.phoneNumber.replace("63", "");
                        $('#phoneNumber').val(phoneNumber);
                        $('#email').val(response.email);
                        $('#userRole').val(response.userRoleID);
                        $('#department').val(response.departmentID);
                        $('#IDnumber').val(response.IDnumber);
                        $('#password').val('******');
                        $('#userStatus').val(response.userStatusID);
                    }
                });
            });

            $(document).on('submit', '#form-edit-user', function(e){
                e.preventDefault();
                var id = $('.btn-confirm').attr('data-id');
                var form = $('#form-edit-user').serialize() + '&userID=' + id;
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "/itd/users/validate-update-email-phone",
                    type: 'POST',
                    data: form,
                    success:function(data){
                        var response = JSON.parse(data);
                        var action_type = 'update';
                        validateSaveUser(response,action_type);
                    }
                });
            });


            $(document).on('click', '.btn-reset-password', function(e){
                var id = $(this).attr('data-id');
                var url = "/itd/reset-password/"+id;
                window.open(url, '_blank');
                // $.ajax({
                //         type: 'get',
                //         url: '/itd/users/generate-password',
                //         success: function(data) {
                //             var response = JSON.parse(data);
                //             $('#password').val(response);
                //         }
                // });
            });

            $(document).on('click', '.btn-archive-user', function(e){
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Confirmation',
                    text: "Are you sure you want to archive this user?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Archive it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'post',
                            url: '/itd/users/archive-user',
                            data: {
                                _token: "{{csrf_token()}}",
                                id: id
                            },
                            success: function(data) {
                                var archivedUsers = parseInt($('#archivedUsers').html(), 10)+1;
                                $('#archivedUsers').html(archivedUsers);
                                users.ajax.reload();
                                Swal.fire(
                                    'Archived!',
                                    'User Successfully Archived.',
                                    'success'
                                );

                            }
                        });


                    }
                })
            });
        });

        function validateSaveUser(response,action_type){
            if((validate.standard('.required-input') == 0) && (response.email > 0 && response.phoneNumber > 0 && response.IDnumber > 0)){
                if(action_type == 'create'){
                    addUser();
                }
                else if(action_type == 'update'){
                    updateUser();
                }
            }
            else{
                if(response.email == 0){
                    $('.email').addClass('err_inputs');
                    $("<span class='validate_error_message'>Email Address already exists.<br></span>").insertAfter('.email');
                }
                if(response.phoneNumber == 0){
                    $('.mobile_number').addClass('err_inputs');
                    $(" <span class='validate_error_message'>Phone Number already exists.<br></span>").insertAfter('.mobile_number');
                }
                if(response.IDnumber == 0){
                    $('#IDnumber').addClass('err_inputs');
                    $(" <span class='validate_error_message'>ID Number already exists.<br></span>").insertAfter('#IDnumber');
                }
                $('.btn-confirm').removeClass('disabled').html('Confirm');
            }
        }

        function addUser(){
            var form = $('#form-add-user').serialize();
            $.ajax({
                url: "/itd/users/create",
                type: 'POST',
                data: form,
                success:function(data){
                    if(data.success === true) {
                        if(data.userStatusID == 1){
                            var activeUsers = parseInt($('#activeUsers').html(), 10)+1;
                            $('#activeUsers').html(activeUsers);
                        } else if(data.userStatusID == 2) {
                            var inactiveUsers = parseInt($('#inactiveUsers').html(), 10)+1;
                            $('#inactiveUsers').html(inactiveUsers);
                        }

                        $('#user-modal').modal('hide');
                        Swal.fire(
                            'Success',
                            'Account Successfuly Added!',
                            'success'
                        );
                        $('#form-add-user').find("input[type=text]").val("");
                        $('#form-add-user').find("input[type=email]").val("");
                        $('#form-add-user').find('input[type=password]').val('');
                        $('select').prop('selectedIndex', 0);
                        $('.email').removeClass('err_inputs');
                        $('.mobile_number').removeClass('err_inputs');
                        $('.validate_error_message').remove();
                        $('.btn-confirm').removeClass('disabled').html('Confirm');
                        users.ajax.reload();
                    }
                }
            });
        }

        function updateUser(){
            var id = $('.btn-confirm').attr('data-id');
            var form = $('#form-edit-user').serialize()+'&userID='+id;
            $.ajax({
                url: "/itd/users/update-user",
                type: 'POST',
                data: form,
                success:function(data){
                    if(data.success === true) {
                        $('#user-modal').modal('hide');
                        // $('.modal-backdrop').hide();
                        Swal.fire(
                            'Success',
                            'Account Successfuly Updated!',
                            'success'
                        );
                        $('.email').removeClass('err_inputs');
                        $('.mobile_number').removeClass('err_inputs');
                        $('.validate_error_message').remove();
                        $('.btn-confirm').removeClass('disabled').html('Update');
                        users.ajax.reload();
                    }
                }
            });
        }
    </script>

@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#active-users').addClass('active');
        });
    </script>
@endsection
