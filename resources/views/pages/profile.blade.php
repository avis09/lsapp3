@extends('layouts.dashboard-master')

@section('title')
    <title>Profile | ITD Bros</title>
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
            <h1><i class="fa fa-dashboard"></i> Profile</h1>
            {{-- <p></p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
          </ul>
        </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-4">
                                    <form id="form-update-profile">
                                        @csrf
                                            <div class="form-group">
                                                <label class="control-label">ID Number</label>
                                                <input type="text" class="form-control" value="{{$userInfo->IDnumber}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control" value="{{$userInfo->firstName.' '.$userInfo->lastName}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                      <label class="control-label" for="contact">Phone Number<span class="required">*</span></label>
                                                      <div class="input-group">
                                                              <div class="input-group-prepend">
                                                                      <select id="areacode" class="form-control required-input" name="areaCode" id="areaCode" required>
                                                                          <option value="63">+63 (PH)</option>
                                                                      </select>
                                                              </div>
                                                              <input type="text" class="form-control required-input mobile_number" name="phoneNumber" id="phoneNumber" value="{{$userInfo->phoneNumber}}" maxlength=10>
                                                      </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" class="form-control" value="{{$userInfo->email}}" disabled>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-primary btn-save-profile btn-md">Save Profile</button>
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
            $(document).on('submit', '#form-update-profile', function(e) {
                e.preventDefault();
                $('.validate_error_message').remove();
                $('.mobile_number').removeClass('err_inputs');
                if(validate.standard('.mobile_number') === 0){
                $('.btn-save-profile').html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
                    var form = $(this);
                    $.ajax({
                       type: "POST",
                       url: "/student/update-profile",
                       data: form.serialize(),
                       success: function(data) {
                           if(data.success === true) {
                               Swal.fire({
                                   type: 'success',
                                   title: 'Success',
                                   text: data.message,
                               })
                                .then((result) => {
                                    if (result.value) {
                                        window.location.href = "/student/schedules/list";
                                    }
                                });
                           }
                            $('.btn-save-profile').html('Save Password').prop('disabled', false);
                       }
                     });
                }
            });
        });
  </script>

    @endsection


