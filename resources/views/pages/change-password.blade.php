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
            <h1><i class="fa fa-dashboard"></i> Change Password</h1>
            {{-- <p></p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Change Password</a></li>
          </ul>
        </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-4">
                                    <form id="form-change-password">
                                        @csrf
                                        <div class="form-group">
                                                <label class="control-label">Current Password <span class="required">*</span></label>
                                                <input type="password" id="current_password" name="current_password" class="form-control password">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password <span class="required">*</span></label>
                                                <input type="password" id="new_password" name="new_password" class="form-control password">
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label">Confirm New Password <span class="required">*</span></label>
                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control password">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-save-password btn-md">Save Password</button>
                                            </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
            </main>

    @endsection

    @section('scripts')
     <script type="text/javascript"> 

        $(document).ready(function() {
            $(document).on('submit', '#form-change-password', function(e) {
                e.preventDefault();
                $('.validate_error_message').remove();
                $('.password').removeClass('err_inputs');
                if(validate.standard('.password') == 0){
                $('.btn-save-password').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                    var form = $(this);
                    $.ajax({
                       type: "POST",
                       url: "/auth/update-password",
                       data: form.serialize(),
                       success: function(data) {
                            if(data.result == 'error'){
                                if(data.field.length > 0){
                                    $.each(data.field, function(x,y){
                                        $('#'+y.field).addClass('err_inputs');
                                        $("<span class='validate_error_message'>"+y.message+"<br></span>").insertAfter('#'+y.field);
                                    });
                                }
                                else{
                                    Swal.fire(
                                      'Error',
                                      'New password cannot be the same as your current password!',
                                      'error'
                                    );
                                }
                            }
                            else{
                                  Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: 'You have successfully changed your password!'
                                  })
                                  .then((result) => {
                                      if (result.value) {
                                        window.location.href = "/itd/users/index";
                                      }
                                    });
                            }

                            $('.btn-save-password').removeClass('disabled').html('Save Password');
                       }
                     });
                }
            });
        });
  </script>

    @endsection


