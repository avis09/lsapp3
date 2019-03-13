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
            <h1><i class="fa fa-dashboard"></i> Rooms</h1>
            {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Rooms</a></li>
          </ul>
        </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-add-venue mb-3">Add Room</button>
                <div class="table-responsive">
                            <table id="table-venues" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Venue Name </th>
                                        <th>Building </th>
                                        <th>Floor </th>
                                        <th>Added by </th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td>Venue Name </td>
                                        <td>Building </td>
                                        <td>Floor </td>
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

        <div class="modal fade" id="venue-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-venue-title" id="smallmodalLabel">Add New Venue</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-venue" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Building <span class="required">*</span></label>
                                <select class="form-control required-input" name="buildingID" id="buildingID" data-parsley-required="true">
                                    <option value="" selected disabled>Select Building</option>
                                        @foreach ($venueB['building'] as $venueBs)
                                            {
                                            <option value="{{ $venueBs->buildingID }}">{{ $venueBs->buildingName  }}</option>
                                            }
                                        @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Venue Name <span class="required">*</span></label> 
                                 <input type="text" class="form-control required-input" name="venueName" id="venueName"> 
                            </div>

                            <div class="form-group">
                                    <label>Venue Floor<span class="required">*</span></label>
                                    <select class="form-control required-input" name="venueFloorID" id="venueFloorID" data-parsley-required="true">
                                            <option value="" selected disabled>Select Venue Floor</option>
                                        @foreach ($venueF['venuefloor'] as $venueFs)
                                            {
                                            <option value="{{ $venueFs->venueFloorID }}">{{ $venueFs->venueFloorName }}</option>
                                            }
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Venue Images <span class="required">*</span></label>
                                <div class="venue-image-container">
                                   <div class="venue-image-parent1">
                                       <div class="input-group venue-image-preview-container1">
                                                    <input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-add-image btn-sm">Add</button>
                                </div>                         
                            </div>
                            <div class="form-group">
                                <label>Equipments <span class="required">*</span></label>
                                <div class="equipment-container">
                                   <div class="equipment-parent1">
                                       <div class="input-group equipment-content1">
                                                    <input type="text" name="equipment_name[]" class="form-control required-input equipment_name" data-ctr="1" placeholder="Equipment Name">
                                                    <input type="text" name="equipment_barcode[]" class="form-control required-input equipment_barcode" data-ctr="1" placeholder="Bar Code">
                                                    <select type="select" name="equipment_status[]" class="form-control required-input equipment-status">
                                                        <option value="" selected disabled>Select Status</option>
                                                        <option value="1">Available</option>
                                                        <option value="2">Unavailable</option>
                                                    </select>
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-danger btn-delete-equipment" data-ctr="1"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-add-equipment btn-sm">Add</button>
                                </div>                      
                            </div>
                            <div class="form-group">
                                <label for="venues">Venue Status <span class="required">*</span></label>
                                <select class="form-control required-input" name="venueStatus" id="venueStatus" data-parsley-required="true">
                                        <option value="" selected disabled>Select Status</option>
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


    @endsection

    @section('scripts')
     <script type="text/javascript"> 


        function addEquipment(){
            equipment_ctr++;
            var html = '';
            html += '<div class="equipment-parent'+equipment_ctr+'">';
            html += '<div class="input-group mt-2 equipment-content'+equipment_ctr+'">';
            html += '<input type="text" name="equipment_name[]" class="form-control required-input equipment_name" data-ctr="'+equipment_ctr+'" placeholder="Equipment Name">';

            html += '<input type="text" name="equipment_barcode[]" class="form-control required-input equipment_barcode" data-ctr="'+equipment_ctr+'" placeholder="Bar Code">';
            html += '<select type="select" class="form-control required-input equipment-status">'+
                            '<option value="" selected disabled>Select Status</option>'+
                            '<option value="1">Available</option>'+
                            '<option value="2">Unavailable</option>'+
                        '</select>';
            html += '<div class="input-group-prepend">';
            html +=    '<button type="button" class="btn btn-danger  btn-delete-equipment" data-ctr="'+equipment_ctr+'"><i class="fas fa-trash-alt"></i></button>';
            html +=   '</div></div></div>';
            $('.equipment-container').append(html);
        }
        var venues;
        var venue_ctr = 1;
        var equipment_ctr = 1;
        $(document).ready(function() {
            $('#menu-venues').addClass('active');
          venues = $('#table-venues').DataTable({
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
            // { data: 'f_venue_type_v.venueTypeName'},
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
                        var equipmentStatus = [];
                        $.each($(".equipment-status option:selected"), function(){            
                            equipmentStatus.push($(this).val());
                        });
                        formData.append('equipmentStatus', JSON.stringify(equipmentStatus));
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
                                        equipment_ctr = 0;
                                        addEquipment();
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
                    $('.modal-venue-title').html('Edit Venue');
                     $.ajax({
                        url: "/registrar/venues/get-specific-room",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id
                        },
                        success:function(data){
                            $('#venue-modal').modal('show');
                            $('#buildingID').val(data.buildingID);
                            $('#venueName').val(data.venueName);
                            $('#venueFloorID').val(data.venueFloorID);
                            $('#venueStatus').val(data.venueStatusID);
                            var html = '';
                            var ctr = 1;
                            equipment_ctr = 0;    
                            $.each(data.f_equipment, function(x,y){
                                equipment_ctr++;
                                html += '<div class="equipment-parent'+equipment_ctr+'">';
                                html += '<div class="input-group mt-2 equipment-content'+equipment_ctr+'">';
                                html += '<input type="text" name="equipment_name[]" value="'+y.equipmentName+'" class="form-control required-input equipment_name" data-ctr="'+equipment_ctr+'" placeholder="Equipment Name">';

                                html += '<input type="text" name="equipment_barcode[]" value="'+y.barCode+'" class="form-control required-input equipment_barcode" data-ctr="'+equipment_ctr+'" placeholder="Bar Code">';
                                html += '<select type="select" class="form-control required-input equipment-status">';
                                html += '<option value="" selected disabled>Select Status</option>';
                                if(y.equipmentStatusID == 1){
                                    html += '<option value="1" selected>Available</option>';
                                    html += '<option value="2">Unavailable</option>';
                                }
                                else{
                                    html += '<option value="1">Available</option>';
                                    html += '<option value="2" selected>Unavailable</option>';
                                }
                                    html += '</select>';
                                html += '<div class="input-group-prepend">';
                                html +=    '<button type="button" class="btn btn-danger  btn-delete-equipment" data-ctr="'+equipment_ctr+'"><i class="fas fa-trash-alt"></i></button>';
                                html +=   '</div></div></div>';
                            });
                            $('.equipment-container').html(html);
                            var html = '';
                            $.each(data.pictures, function(x,y){
                                html += '<div class="venue-image-parent'+ctr+'">';
                                html += '<div class="input-group venue-image-preview-container'+ctr+'">';
                                html +=   '<input type="file" name="venue_image[]" value="'+y.pictureName+'" class="form-control required-input file-venue-image" data-ctr="'+ctr+'">';
                                html += '<div class="input-group-prepend">';
                                html += '<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="'+ctr+'"><i class="fas fa-trash-alt"></i></button>';
                                html += '</div></div>';
                                html += '<img class="venue-image my-2" src="/storage/venue images/rooms/'+y.pictureName+'">';
                                html += '</div>';
                                ctr++;
                            });
                            $('.venue-image-container').html(html);
                        
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


            $(document).on('click', '.btn-archive-venue', function (e) {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Confirmation',
                    text: "Are you sure you want to archive this room?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        var type = 3;
                        $.ajax({
                            type: 'post',
                            url: '/registrar/venue/update-status',
                            data: {
                                _token: "{{csrf_token()}}",
                                id: id,
                                type: type
                            },
                            success: function (data) {
                                venues.ajax.reload();
                                Swal.fire(
                                    data.title,
                                    data.content_message,
                                    data.type
                                );
                            }
                        });
                    }
                })
            });


            $(document).on('click', '.btn-add-equipment', function(e){
                addEquipment();
            });
            
            $(document).on('click', '.btn-delete-equipment', function(e){
                var ctr = $(this).attr('data-ctr');
                $('.equipment-parent'+ctr).remove();
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