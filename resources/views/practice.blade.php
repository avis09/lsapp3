@extends('layouts.dashboard-master')

@section('title')
    <title>Send Feedback | Bros</title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        #comment{
            height: 130px;
            resize: none;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-certificate"></i> Send Feedback </h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Feedbacks</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form id="form-send-feedback">
                        <div class="alert-message hidden">
                        </div>
                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Venue <span class="required">*</span></label>
                            <textarea class="form-control required-input" name="venue" id="venue"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Name <span class="required">*</span></label>
                            <textarea class="form-control required-input" name="name" id="name"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Time <span class="required">*</span></label>
                            <textarea class="form-control required-input" name="time" id="time"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-send-feedback">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-feedbacks').addClass('active');
            $(document).on('submit', '#form-send-feedback', function (e) {
                e.preventDefault();
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                if(validate.standard('.required-input') == 0){
                    $('.btn-send-feedback').html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
                    var form = $('#form-send-feedback').serialize();
                    $.ajax({
                        url: "{{url("/student/add")}}",
                        type: "POST",
                        data: form,
                        success: function(data){
                            $('.btn-send-feedback').html('Send Feedback').prop('disabled', false);
                            if(data.success){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: data.message,
                                })
                                    .then((result) => {
                                        if (result.value) {
                                            $('#venue-modal').modal('hide');
                                            $('select').prop('selectedIndex', 0);
                                            $('#venue-name').children('option:not(:first)').remove();
                                            $('textarea').val('');
                                        }
                                    });
                            }
                        }
                    });
                }
                return false;
            });
        });
    </script>

@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-feedbacks').addClass('active');
        });
    </script>
@endsection
