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
        .venue-image{
            height: 120px;
            width: 120px;
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
                            <td>Added by </td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script type="text/javascript">
        var venues;
        var venue_ctr = 1;
        $(document).ready(function() {
            $('#menu-venues').addClass('active');
            venues = $('#table-venues').DataTable({
                ajax: {
                    url: "/gasd/venues/get-venues",
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
                            return '<button type="button" class="btn btn-primary btn-edit-venue btn-sm" data-id="'+data.venueID+'">Edit</button> '+
                                '<button type="button" class="btn btn-secondary btn-archive-venue btn-sm" data-id="'+data.venueID+'">Archive</button>';

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


            $(document).on('submit', '#form-add-venue', function(e){
                e.preventDefault();
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                if(validate.standard('.required-input') == 0){
                    $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                    var formData = new FormData(this);
                    $.ajax({
                        url: "/registrar/venues/add-venue",
                        type: 'POST',
                        data: formData,
                        async: false,
                        success:function(data){
                            if(data.success === true){
                                Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: data.message,
                                })
                                    .then((result) => {
                                        if (result.value) {
                                            $('#venue-modal').modal('hide');
                                            var html = '';
                                            html += '<div class="venue-image-parent1">';
                                            html += '<div class="input-group venue-image-preview-container1">';
                                            html +=   '<input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">';
                                            html += '<div class="input-group-prepend">';
                                            html += '<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>';
                                            html += '</div></div></div>';
                                            $('.venue-image-container').html(html);
                                            $('select').prop('selectedIndex', 0);
                                            $('input[type="text"]').val('');
                                        }
                                    });
                                venues.ajax.reload();
                            }
                            $('.btn-confirm').removeClass('disabled').html('Confirm');
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                    });
                }
            });

            $(document).on('click', '.btn-edit-venue', function(){
                var id = $(this).attr('data-id');
                $('.validate_error_message').remove();
                $('.required-input').removeClass('err_inputs');
                $.ajax({
                    url: "/registrar/venues/get-specific-venues",
                    type: 'POST',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id
                    },
                    success:function(data){
                        $('venue-image').modal('show');
                        var html = '';
                        $.each(data.venueImages, function(x,y){
                            html += '<div class="venue-image-parent1">';
                            html += '<div class="input-group venue-image-preview-container1">';
                            html +=   '<input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">';
                            html += '<div class="input-group-prepend">';
                            html += '<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>';
                            html += '</div></div></div>';
                            $('.venue-image-container').html(html);
                        });
                    }
                });
            });

            $(document).on('click', '.btn-add-image', function(e){
                venue_ctr++;
                var html = '';
                html += '<div class="venue-image-parent'+venue_ctr+'">';
                html += '<div class="input-group mt-2 venue-image-preview-container'+venue_ctr+'">';
                html += '<input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="'+venue_ctr+'">';
                html += '<div class="input-group-prepend">';
                html +=    '<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="'+venue_ctr+'"><i class="fas fa-trash-alt"></i></button>';
                html +=   '</div></div></div>';
                $('.venue-image-container').append(html);
            });

            $(document).on('click', '.btn-delete-venue-image', function(e){
                var ctr = $(this).attr('data-ctr');
                $('.venue-image-parent'+ctr).remove();
            });


            $(document).on('change', '.file-venue-image', function(){
                var test = this;
                var FileUploadPath = this.value;
                var file_size = this.files[0].size;
                var ctr = $(this).attr('data-ctr');
                var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                if (Extension != "gif" && Extension != "png" && Extension != "bmp"
                    && Extension != "jpeg" && Extension != "jpg") {
                    Swal.fire(
                        'Error',
                        'Invalid File Format!',
                        'error'
                    );
                    this.value = '';
                }
                else if(file_size > 2000000){
                    swal.fire(
                        'Error',
                        'File is too big!',
                        'error'
                    );
                    this.value = '';
                }
                else {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var html = '<img class="venue-image my-2" src="'+e.target.result+'">';
                            $(html).insertAfter('.venue-image-preview-container'+ctr);
                        }
                        reader.readAsDataURL(this.files[0]);

                    }
                }
            });
        });
    </script>

@endsection
    {{--<div class="modal fade" id="venue-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<span class="modal-title modal-venue-title" id="smallmodalLabel">Add New Venue</span>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">×</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<form class="form-venue" enctype="multipart/form-data">--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="form-group">--}}
                            {{--<label>Building <span class="required">*</span></label>--}}
                            {{--<select class="form-control required-input" name="buildingID" id="buildingID" data-parsley-required="true">--}}
                                {{--<option value="" selected disabled>Select Building</option>--}}
                                {{--@foreach ($venueB['building'] as $venueBs)--}}
                                    {{--{--}}
                                    {{--<option value="{{ $venueBs->buildingID }}">{{ $venueBs->buildingName  }}</option>--}}
                                    {{--}--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<input type="hidden" name="_token" id="token" value="{{csrf_token()}}">--}}
                        {{--<div class="form-group">--}}
                            {{--<label>Venue Name <span class="required">*</span></label>--}}
                            {{--<input type="text" class="form-control required-input" name="venueName" id="venueName">--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label>Venue Floor<span class="required">*</span></label>--}}
                            {{--<select class="form-control required-input" name="venueFloorID" id="venueFloorID" data-parsley-required="true">--}}
                                {{--<option value="" selected disabled>Select Venue Floor</option>--}}
                                {{--@foreach ($venueF['venuefloor'] as $venueFs)--}}
                                    {{--{--}}
                                    {{--<option value="{{ $venueFs->venueFloorID }}">{{ $venueFs->venueFloorName }}</option>--}}
                                    {{--}--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label>Venue Images <span class="required">*</span></label>--}}
                            {{--<div class="venue-image-container">--}}
                                {{--<div class="venue-image-parent1">--}}
                                    {{--<div class="input-group venue-image-preview-container1">--}}
                                        {{--<input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">--}}
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="mt-2">--}}
                                {{--<button type="button" class="btn btn-primary btn-add-image btn-sm">Add</button>--}}
                            {{--</div>--}}
                            {{--<!-- <table id="table-venue-images" class="table table-bordered table-sm">--}}
                                {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<td>Image </td>--}}
                                        {{--<td>Actions</td>--}}
                                    {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody class="venue-images">--}}

                                {{--</tbody>--}}
                            {{--</table> -->--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="venues">Venue Status <span class="required">*</span></label>--}}
                            {{--<select class="form-control required-input" name="venueStatus" id="venueStatus" data-parsley-required="true">--}}
                                {{--<option value="" selected disabled>Select Status</option>--}}
                                {{--@foreach ($venueST['venueStatus'] as $venueSTs)--}}
                                    {{--{--}}
                                    {{--<option value="{{ $venueSTs->venueStatusID }}">{{ $venueSTs->venueStatusType }}</option>--}}
                                    {{--}--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer text-right">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
                        {{--<button type="submit" class="btn btn-primary btn-confirm">Confirm</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <!--     <div class="modal fade" id="venue-image-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
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
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-confirm-venue-image">Confirm</button>
                    </div>
                </div>
            </div>
        </div> -->




<!--
<div>
        <table width="90%" style="font-family: calibri; background-color: #ccc; border: 1px solid #555" align="center" cellpadding="0" cellspacing="0">

                <tr style="background-color: #298430;">
                    <td style="border-bottom: 1px solid #126418; background-color: #298430; color: #fff; padding: 10px 15px;">
                        <h2 style="margin: 10px; display: inline-block;">BROS</h2>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 30px 50px 40px 50px; background-color: #eee; font-family: calibri; line-height: 30px;">
                        <p>Dear <strong>'.$name.'</strong></span> <br/></p>
                        <p>Sorry to inform you that your request has been rejected.</p?
                        <br/>
                        <br/>
                        Thank you.
                        <br>
                        <br/>
                        Regards,
                        <br/>
                        <strong>ITD</strong>
                        </p>
                    </td>
                </tr>
        </table>
        <div style="text-align: center; font-family: calibri; font-size: 12px; margin-top: 10px;">
        </div>
    </div>
     -->