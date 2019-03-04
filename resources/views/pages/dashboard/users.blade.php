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

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">598</span></div>
                                            <div class="stat-heading">Active Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">3</span></div>
                                            <div class="stat-heading">Students</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">5</span></div>
                                            <div class="stat-heading">Archived Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">20</span></div>
                                            <div class="stat-heading">Inactive Users </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

                <div class="clearfix"></div>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-add-user mb-3" data-toggle="modal" data-target="#user-modal">Add Account</button>
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

               
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
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
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Account Type <span class="required">*</span></label>
                                <select class="form-control required-input" name="userrole" id="userRole" data-parsley-required="true">
                                    <option value="">Select Role Type</option>
                                    @foreach ($userRs['userrole'] as $userR)
                                        {
                                        <option value="{{ $userR->userRoleID }}">{{ $userR->roleType }}</option>
                                        }
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" class="form-control required-input" name="firstName" id="firstName">
                                    </div>
                                    <div class="col-md-6">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" class="form-control required-input" name="lastName" id="lastName">
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-group">
                                    <label class="labelinput" for="contact">Phone Number<span class="required">*</span></label>
                                    <div class="input-group contact-number">
                                            <div class="input-group-prepend">
                                                    <select id="areacode" class="form-control required-input" name="areaCode" id="areaCode" required>
                                                        <option value="63">+63 (PH)</option>
                                                    </select>
                                            </div>
                                            <input type="text" class="form-control required-input mobile_number" name="phoneNumber" id="phoneNumber" maxlength=10>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input email" name="email" id="email">
                            </div>
                        
                            {{--departmentID--}}
                            <div class="form-group">
                                <label>Department <span class="required">*</span></label>
                                <select class="form-control required-input" name="department" id="department" data-parsley-required="true">
                                    <option value="" disabled selected>Select Department</option>
                                    @foreach ($userDs['department'] as $userD)
                                        {
                                    <option value="{{ $userD->departmentID }}">{{ $userD->departmentName }}</option>
                                        }
                                        @endforeach
                                </select>
                            </div>
                            {{--ID number--}}

                            <div class="form-group">
                                    <label>ID Number <span class="required">*</span></label>
                                    <input type="text" class="form-control numbers-only required-input" name="IDnumber" id="IDnumber">
                            </div>
                            <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="text" class="form-control required-input password" name="password" id="password" readonly>
                            </div>
                            <div class="form-group">
                               <label>Status <span class="required">*</span></label>
                               <select class="form-control required-input" name="userStatus" id="userStatus" data-parsley-required="true">
                                <option value="">Select Status</option>
                                    @foreach ($userSs['userstatus'] as $userS)
                                        {
                                          <option value="{{ $userS->userStatusID }}">{{ $userS->userStatusType }}</option>
                                        }
                                     @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-confirm">Confirm</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

<!-- 
<div id="slider_image_modal" class="modal fade" data-backdrop="static" role="dialog" style="overflow:auto;">
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
                        <button class="btn btn-success btn_confirm_addImage" id="">Add</button>
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
          users = $('#table-users').DataTable({
            ajax: {
            url: "/itd/users/get-users",
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
            { data: null,
                render:function(data){
                    return '<button type="button" class="btn btn-primary btn-edit-user btn-sm" data-id="'+data.userID+'" data-toggle="modal" data-target="#user-modal">Edit</button>';

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
          
          $('.btn-secondary').click(function(){
            $('#user-modal').modal('hide');
          });
               $(document).on('click', '.btn-add-user', function(e){
                 e.preventDefault();        
                //  $('#user-modal').remove('fade in');
                //   $('#user-modal').addClass('show');
                //   $('#user-modal').modal('show');
                $('input[type="text"]').val("");
                $('input[type="password"]').val("");
                $('input[type="email"]').val("");
                $('select').prop("selectedIndex", 0);
                $('.modal-user-title').html('Add New Account');
                $('.form-user').attr('id', 'form-add-user');
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
                            validateAddUser(response);
                        }
                    });
            });

            $(document).on('click', '.btn-edit-user', function(){
                    var id = $(this).attr('data-id');
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
                                $('#user-modal').modal('hide');
                                // $('.modal-backdrop').hide();
                                 Swal.fire(
                                      'Success',
                                      'Account Successfuly Added!',
                                      'success'
                                );
                        }
                    },
                    complete:function(data){
                        if(data.success === true) {
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



<!-- 

DEPENDENCY

<style type="text/css">
    #slider_image_modal {
        z-index: 1049;
    }
    .img_banner_preview {
        width: 100px !important;
    }
    #slider_image_modal i {
        width: 100%;
        float: left;
    }
    .custom_add_content i {
        width: 100%;
        float: left;
    }
</style>

<div class="box">
 <?php $data["buttons"] = ["save","close"]; ?>
    <?php $this->load->view("content_management/template/buttons", $data); ?>

    <div class="box-body custom_add_content">
        <form id="custom_add_content" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2">Article Content Template</label>
            <div class="col-sm-10">
                <select id="frames_list" class="frame_id form-control required_input" name="contentTemplate_id">
                    <option value="" selected="" disabled>Select Frame</option>
                <?php
                    foreach ($frames as $key => $frame) {
                ?>
                    <option value="<?=$frame->id?>"><?=$frame->contentTemplate_title?></option>
                <?php }
                ?>
                </select>
            </div>
            <div class="clearfix"></div>
            <input type="hidden" name="article_id" value="<?=$id?>">
        </div>
        <div class="show-frame-fields"></div>
        </form>
    </div>
</div>


<div id="slider_image_modal" class="modal fade" data-backdrop="static" role="dialog" style="overflow:auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title social_modal_title">Add Slider</h4>
            </div>
            <div class="modal-body">
                <?php
                $inputs = [
                    'slider_title',
                    'slider_description'
                ];

                $this->standard->inputs($inputs);
               ?>
                <div class="slider_image_group">
                <?php
                $inputs = [
                    'horizontal_slider_image'
                ];

                $this->standard->inputs($inputs);
               ?>
                </div>
                <div class="form-group" style="padding: 10px 0px;">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10 text-right">
                        <button class="btn btn-success btn_confirm_addImage" id="">Add</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
    var frame = "";
    $('#frames_list').on('change', function(e){
        e.preventDefault();
        var frame = $('#frames_list').val();

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>content_management/articleContent/loadFrameValues",
            data: {frame:frame},
            success:function(data){
                $('.show-frame-fields').html(data);
                $('.status_image').hide();
                if(frame == 10){
                    $('.image-dimension').html('<b>Required Dimension:</b> 798 x 337 pixels');
                }
                if(frame == 5){
                    $('.slider_image_group').hide();
                }
                else{
                     $('.slider_image_group').show();
                }
            }
        });

    });

    $(document).on('click', '.btn_close', function(e){
        location.href = "<?=base_url()?>content_management/articleContent/list/<?=$id?>";
    });
    $(document).on('click','.btn_status',function(e){
        var status = $(this).attr("data-status");
        var id = "";
        var status_msg = '';

        if(status == 0){
            var modal_obj = '<?= $this->standard->confirm("confirm_unpublish"); ?>'; 
        }
        if(status == 1){
            var modal_obj = '<?= $this->standard->confirm("confirm_publish"); ?>'; 
        }
        if(status == -2){
            var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
        }
        var result_message = "";
        modal.standard(modal_obj, function(result){
            modal.loading(true);
            if(result){
                $('.selectall_image').prop('checked', false);
                $('.select_image:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    if(status==1){
                        status_msg = 'Active';
                    }
                    if(status==0){
                        status_msg = 'Inactive';
                    }
                    if(status==-2){
                        $(this).closest('tr').hide();
                    }
                    $(this).closest('tr').find('.slider_stat').val(status);
                    $(this).closest('tr').find('.slide_status').html(status_msg);
                    
                    modal.loading(false);
                });

                modal.alert("<?= $this->standard->dialog("update_success"); ?>", function(){
                    $('.select_image').prop('checked', false);
                    $('.btn_status').hide();    
                });
            }

        })
    });
    $(document).on('click', '.btn_add_image', function(e){
        e.preventDefault();
        $('#slider_title').val('');
        $('#slider_image').val('');
        CKEDITOR.instances.slider_description.setData('');
        $(".social_modal_title").html('Add Slider Image');
        $('#slider_image_modal').find('.img_banner_preview').remove();
        $('.btn_confirm_addImage').html('Add');
        $('.btn_confirm_addImage').attr('id','');
        $('#slider_image_modal').modal('show');
    });
    $(document).on('click', '.edit_image', function(e){
        e.preventDefault();
        var slider_title = $(this).closest('tr').find('.slide_title').html();
        var slider_image = $(this).closest('tr').find('.slide_img').attr('attr_src');
        var img_src = (slider_image == "") ? "" : "<?=base_url()?>"+slider_image;
        var slider_description = $(this).closest('tr').find('.slide_description').html();
        $('#slider_title').val(slider_title);
        $('#slider_image').val(slider_image);
        CKEDITOR.instances.slider_description.setData(slider_description);
        $('#slider_image_modal').find('.img_banner_preview').attr('src',img_src);
        $(".social_modal_title").html('Update Slider Image');
        $('.btn_confirm_addImage').html('Update');
        $('.btn_confirm_addImage').attr('id',$(this).closest('tr').index());
        $('#slider_image_modal').modal('show');
    });

    $(document).on('click', '.btn_confirm_addImage', function(e) {
        var frame = $('#frames_list').val();
        e.preventDefault();
        var slider_title = $('#slider_title').val();
        var slider_image = $('#slider_image').val();
        var img_src = (slider_image == "") ? "" : "<?=base_url()?>"+slider_image;
        var slider_description = CKEDITOR.instances.slider_description.getData();
        var data_id = $(this).attr('id');
        var htm1 = '';
        var htm2 = '';
        var htm3 = '';
        //if(validate.standard()){
            htm1 += '<tr>';
                htm2 +='<td><input class="select_image" type="checkbox" data-id="1" onchange="checkbox_check()"></td>';

   
                htm2 +='<input type="hidden" name="slider_img_status[]" value="1" class="slider_stat">';
                if(slider_image == "" || slider_image == " "){
                htm2 +='<input type="hidden" name="slider_img[]" value="NULL">';
                }
                else{
                htm2 +='<input type="hidden" name="slider_img[]" value="'+slider_image+'">';
                }
                if(frame != 5){
                
                htm2 += '<td><img  class="slide_img" attr_src="'+slider_image+'" src="'+img_src+'" width="100px;"></td>'; 
                    }

                if(slider_title == "" || slider_title == " ") {
                htm2 += '<input type="hidden" name="slider_title[]" value="NULL">';
                }
                else{
                htm2 += '<input type="hidden" name="slider_title[]" value="'+slider_title+'">';
                }

                if(slider_description == "" || slider_description == " ") {
                htm2 += '<input type="hidden" name="slider_description[]" value="NULL">';
                }
                else{
                htm2 += '<input type="hidden" name="slider_description[]" value="'+slider_description+'">';
                }



                htm2 +='<td class="slide_title">'+slider_title+'</td>';
                htm2 +='<td class="slide_description" style="display:none;">'+slider_description+'</td>';
                htm2 +='<td class="slide_status">Active</td>';
                htm2 +='<td><a class="edit_image" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a></td>';
            htm3 +='</tr>';
            if(data_id==''){
                htm1 = htm1 + htm2 + htm3;
                $('.slider_table tbody').append(htm1);
            }
            else{
                $('.slider_table tbody tr:eq('+data_id+')').html(htm2);
            }
            
            $('#slider_image_modal').find('.img_banner_preview').attr('src','');
            $('#slider_image_modal').modal('hide');

            // return false;
        
    });

    $(document).on('change', '.select_image', function(){
        var del = 0;
        var x = 0;
        $('.select_image').each(function() {  
            var ischecked =  $(this).is(":checked");
            if (this.checked==true) { x++; } 
            if (x > 0 ) {
                $('.status_image').show();
            } else {
                $('.status_image').hide();
                $('.selectall_image').attr('checked', true);
            }
        });
    });

    function checkbox_check() {
        var checkbox_count = document.querySelectorAll('input[class="select_image"]').length;
        var checked_checkboxes_count = document.querySelectorAll('input[class="select_image"]:checked').length;

        if (checkbox_count == checked_checkboxes_count) {
            $(".selectall_image").prop("checked", true);
        } else {
            $(".selectall_image").prop("checked", false);
        }
    }

    $(document).on('change', '.selectall_image', function(){
        var del = 0;
        if(this.checked) { 
            $('.select_image').each(function() { 
                this.checked = true;  
                $('.status_image').show();         
            });
        } else {
            $('.select_image').each(function() { 
                $('.status_image').hide();
                this.checked = false;                 
            });         
        }
    });

     $('.btn_save').on('click', function(){
       
        var form_serialize = $('#custom_add_content').serialize();
        var description = ($('#description').length == 1) ? CKEDITOR.instances.description.getData() : "";
        var shortDescription = ($('#shortDescription').length == 1) ? CKEDITOR.instances.shortDescription.getData() : "";
        var quote = ($('#quote').length == 1) ? CKEDITOR.instances.quote.getData() : "";
        // $('#slider_title').val('a');
        // $('#slider_image').val('a.jpg');
        var slider_description = ($('#quote').length == 1) ? CKEDITOR.instances.slider_description.getData() : "";
        if(validate.standard()){
            if(isExists('pckg_articlecontents', 'articleContent_title', $('#title').val(), 'articleContent_status') != 0){
                var error_message = "<span class='validate_error_message' style='color: red;'>The information already exists.<br></span>";
                $('#title').css('border-color','red');
                $(error_message).insertAfter($('#title'));
            }else{

                var modal_obj = '<?= $this->standard->confirm("confirm_add"); ?>'; 
                modal.standard(modal_obj, function(result){
                    if(result){
                        modal.loading(true);
                        var url = "<?= base_url('content_management/articleContent/saveContent');?>";
                        var data = {
                            data : {
                                    serializeData : form_serialize,
                                    description : description,
                                    shortDescription : shortDescription,
                                    quote : quote,
                                    articleContent_create_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                                    articleContent_update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                            }  
                        }
                        aJax.post(url,data,function(result){
                            modal.loading(false);
                            modal.alert("<?= $this->standard->dialog("add_success"); ?>", function(){
                                location.href = "<?=base_url()?>content_management/articleContent/list/<?=$id?>";
                            });
                        })
                    }
                });

            }

        }
    }); 

 });
</script>

--?