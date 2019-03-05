@extends('layouts.dashboard-master')

@section('title')
    <title>Registrar Venues | ITD Bros</title>
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
            <h1><i class="fa fa-dashboard"></i> Registrar Venues</h1>
            {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Venues</a></li>
          </ul>
        </div>
      <!--   <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Venues</h4>
                <p><b>5</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4></h4>
                <p><b>25</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Inactive Users</h4>
                <p><b>10</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Archived Users</h4>
                <p><b>500</b></p>
              </div>
            </div>
          </div>
        </div> -->
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-add-venue mb-3">Add Venue</button>
                    <div class="table-responsive">
                                <table id="table-venues" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Venue Name </td>
                                            <td>Building </td>
                                            <td>Floor </td>
                                            <td>Venue Type </td>
                                            <td>Added by </td>
                                            <td>Status</td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Venue Name </td>
                                            <td>Building </td>
                                            <td>Floor </td>
                                            <td>Venue Type </td>
                                            <td>Venue Status</td>
                                            <td>Added by User Type </td>
                                            <td>Actions</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>
            </main>
    
        <div class="modal fade" id="venue-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-venue-title" id="smallmodalLabel">Add New Venue</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-venue">
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Building <span class="required">*</span></label>
                                <select class="form-control required-input" name="buildingID" id="buildingID" data-parsley-required="true">
                                        @foreach ($venueB['building'] as $venueBs)
                                            {
                                            <option value="{{ $venueBs->buildingID }}">{{ $venueBs->buildingName  }}</option>
                                            }
                                        @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Venue Name </label> 
                                 <input type="text" class="form-control required-input" name="venueName" id="venueName"> 
                            </div>

                            <div class="form-group">
                                    <label>Venue Room<span class="required">*</span></label>
                                    <select class="form-control required-input" name="venueFloorID" id="venueFloorID" data-parsley-required="true">
                                        @foreach ($venueF['venuefloor'] as $venueFs)
                                            {
                                            <option value="{{ $venueFs->venueFloorID }}">{{ $venueFs->venueFloorName }}</option>
                                            }
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Venue Images <span class="required">*</span></label>
                                <div class="my-2">
                                    <button type="button" class="btn btn-primary btn-add-image btn-sm">Add</button>
                                </div>
                                
                                <table id="table-venue-images" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <td>Image </td>
                                            <td>Status </td>
                                            <td>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody class="venue-images">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="venues">Venue Status <span class="required">*</span></label>
                                <select class="form-control required-input" name="venueStatus" id="venueStatus" data-parsley-required="true">
                                    @foreach ($venueST['venueStatus'] as $venueSTs)
                                        {
                                        <option value="{{ $venueSTs->venueStatusID }}">{{ $venueSTs->venueStatusType }}</option>
                                        }
                                    @endforeach
                                </select>
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


<div class="modal fade" id="venue-image-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title modal-venue-image-title" id="smallmodalLabel">Add New Image</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Image <span class="required">*</span></label>
                    <input type="file" name="venue_image" id="venue-image" class="form-control required-input">
                </div>
<!--                 <div class="form-group">
                    <label>Status <span class="required">*</span></label>
                    <input type="" name="">
                </div> -->
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-confirm-venue-image">Confirm</button>
            </div>
            </div>
        </div>
    </div>


    @endsection

    @section('scripts')
     <script type="text/javascript"> 
        var users;
        $(document).ready(function() {
            $('#menu-venues').addClass('active');
          users = $('#table-venues').DataTable({
            ajax: {
            url: "/registrar/venues/get-venues",
            dataSrc: ''
            },
            responsive:true,
                // "order": [[ 5, "desc" ]],
            columns: [
            // { data: 'userID'},
            { data: 'venueName'},
            { data: 'f_building_v.buildingName'},
            { data: 'floor.venueFloorName'},
            { data: 'f_venue_type_v.venueTypeName'},
            { data: null,
                render:function(data){
                    return data.f_user_v.firstName+' '+data.f_user_v.lastName;

                }
            },
            // { data: 'f_department.departmentName'},
            { data: 'f_venue_status_v.venueStatusType'},
            
            // { data: 'actions'},
            { data: null,
                render:function(data){
                    return '<button type="button" class="btn btn-primary btn-edit-venue btn-sm" data-id="'+data.userID+'">Edit</button> '+
                    '<button type="button" class="btn btn-secondary btn-archive-venue btn-sm" data-id="'+data.userID+'">Archive</button>';

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
          
               $(document).on('click', '.btn-add-venue', function(e){
                 e.preventDefault();        
                //  $('#venue-modal').remove('fade in');
                //   $('#venue-modal').addClass('show');
                //   $('#venue-modal').modal('show');
                $('.btn-reset-password').hide();
                $('input[type="text"]').val("");
                $('input[type="password"]').val("");
                $('input[type="email"]').val("");
                $('select').prop("selectedIndex", 0);
                $('.modal-venue-title').html('Add New Venue');
                $('.form-venue').attr('id', 'form-add-venue');
                $('#venue-modal').modal('show');
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
                            validateAddUser(response);
                        }
                    });
            });

            $(document).on('click', '.btn-edit-venue', function(){
                    var id = $(this).attr('data-id');
                    $('.btn-reset-password').show();
                    $('.modal-venue-title').html('Edit Account');
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
                            $('#venue-modal').modal('show');
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
            $(document).on('click', '.btn-add-image', function(e){
                $('#venue-image-modal').modal('show');
            });
            

        });

            function validateAddUser(response){
                if((validate.standard('.required-input') == 0) && (response.email > 0 && response.phoneNumber > 0 && response.IDnumber > 0)){
                        addUser();
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
                            $('#venue-modal').modal('hide');
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


