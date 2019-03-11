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
                <h1><i class="fa fa-dashboard"></i> Archived Users List</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
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
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <!--
    <div id="add-image-modal" class="modal fade" data-backdrop="static" role="dialog" style="overflow:auto;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title social_modal_title">Add Slider</h4>
                </div>
                <div class="modal-body">

                    </div>
                    <div class="form-group" style="padding: 10px 0px;">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10 text-right">
                            <button class="btn btn-primary btn_confirm_addImage" id="">Add</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
     -->

@endsection

@section('scripts')
    <script type="text/javascript">
        var users;
        $(document).ready(function() {
            $('#menu-user-reports').addClass('is-expanded');
            $('#archived-users').addClass('active');
            users = $('#table-users').DataTable({
                ajax: {
                    url: "/itd/users/get-archivedusers",
                    dataSrc: ''
                },
                responsive:true,
                // "order": [[ 5, "desc" ]],
                columns: [
                    // { data: 'userID'},
                    { data: 'IDnumber'},
                    { data: null,
                        render:function(data){
                            return data.firstName+' '+data.lastName;

                        }
                    },

                    { data: 'email'},
                    { data: 'phoneNumber'},
                    { data: 'f_userrole.roleType'},
                    // { data: 'f_department.departmentName'},
                    { data: 'f_userstatus.userStatusType'},

                    // { data: 'actions'},

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
                $.ajax({
                    url: "/itd/users/generate-password",
                    type: 'GET',
                    success:function(data){
                        var response = JSON.parse(data);
                        $('#password').val(response);
                    }
                })
            });


            $(document).on('submit', '#form-add-user', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "/itd/users/validate-email-phone",
                    type: 'POST',
                    data: form,
                    success:function(data){
                        var response = JSON.parse(data);
                        validateSaveUser(response);
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
                        $('#user-modal').modal('show');
                        var response = JSON.parse(data);
                        $('#firstName').val(response.firstName);
                        $('#lastName').val(response.lastName);
                        $('#areaCode').val(response.areaCode);
                        $('#phoneNumber').val(response.phoneNumber);
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
                var form = $(this).serialize() + '&userID=' + id;
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                $.ajax({
                    url: "/itd/users/validate-update-email-phone",
                    type: 'POST',
                    data: form,
                    success:function(data){
                        var response = JSON.parse(data);
                        var action_type = 'edit';
                        validateSaveUser(response,action_type);
                    }
                });
            });

            $(document).on('click', '.btn-reset-password', function(e){
                $.ajax({
                    type: 'get',
                    url: '/itd/users/generate-password',
                    success: function(data) {
                        var response = JSON.parse(data);
                        $('#password').val(response);
                    }
                });
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
                        $('#user-modal').modal('hide');
                        // $('.modal-backdrop').hide();
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
                        $('.btn-confirm').removeClass('disabled').html('Sign Up');
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
            $('#archived-users').addClass('active');
        });
    </script>
@endsection
