@extends('layouts.dashboard-master')

@section('title')
    <title>Reservation Settings | BROS</title>
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
            <h1><i class="fa fa-dashboard"></i> Reservation Settings</h1>
            {{-- <p></p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Reservation Settings</a></li>
          </ul>
        </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="col-md-12">
                            <div class="row">
                            <div class="col-md-4">
                                <form id="form-save-settings">
                                    @csrf
                                    <div class="form-group">
                                            <label class="control-label">Start Date <span class="required">*</span></label>
                                            @php $startDate = (!empty($settings->startDate)) ? $settings->startDate : ""; @endphp
                                            @php $endDate = (!empty($settings->endDate)) ? $settings->endDate : ""; @endphp
                                    <input type="date" id="startDate" name="startDate" class="form-control required-input" min="{{date('Y-m-d')}}" value="{{$startDate}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">End Date <span class="required">*</span></label>
                                            <input type="date" id="endDate" name="endDate" class="form-control required-input" min="{{$settings->startDate}}" value="{{$endDate}}">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-save-settings btn-md">Save Settings</button>
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
                $(document).on('change', '#startDate', function(){
                    $('#endDate').attr('min', $(this).val());
                });

            $(document).on('submit', '#form-save-settings', function(e) {
                e.preventDefault();
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                if(validate.standard('.required-input') == 0){
                $('.btn-save-settigs').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                    var form = $(this);
                    $.ajax({
                       type: "POST",
                       url: "/itd/update-reservation-settings",
                       data: form.serialize(),
                       success: function(data) {
                            if (data.success === true) {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: data.message
                                  })
                                  .then((result) => {
                                      location.reload();
                                    });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: data.message
                                  })
                            }

                            $('.btn-save-settings').removeClass('disabled').html('Save Settings');
                       }
                     });
                }
                return false;
            });
        });
  </script>

    @endsection


