@extends('layouts.dashboard-master')

@section('title')
    <title>Room Venues | Registrar BROS</title>
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
                                        <th>Building</th>
                                        <th>Modified By</th>
                                        <th>Date Modified</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Venue Name </th>
                                        <th>Building</th>
                                        <th>Modified By</th>
                                        <th>Date Modified</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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
                                <p class="recommender-dimension"><b>Recommended Dimension: 320 x 280 pixels.</b></p>
                                <div class="venue-image-message"></div>
                                <div class="venue-image-container">
                                   <div class="venue-image-parent1">
                                       <div class="input-group venue-image-preview-container1">
                                                    <input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                        </div>
                                        <div class="venue-image-preview1"></div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-add-image btn-sm">Add</button>
                                </div>                         
                            </div>
                            <div class="form-group">
                                <label>Equipments <span class="required">*</span></label>
                                <div class="equipment-message"></div>
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

        function resetVenueImage(){
            var html = '';
                html += '<div class="venue-image-parent1">';
                html += '<div class="input-group venue-image-preview-container1">';
                html +=   '<input type="file" name="venue_image[]" class="form-control required-input file-venue-image" data-ctr="1">';
                html += '<div class="input-group-prepend">';
                 html += '<button type="button" class="btn btn-danger btn-delete-venue-image" data-ctr="1"><i class="fas fa-trash-alt"></i></button>';
                html += '</div></div>';
                html += '<div class="venue-image-preview1"></div>';
                html += '</div>';
                $('.venue-image-container').html(html);
        }

        function resetEquipment(){
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
            $('.equipment-container').html(html);
        }
        var venues;
        var venue_ctr = 1;
        var equipment_ctr = 1;
        $(document).ready(function() {
            $('#menu-venues').addClass('active');
          venues = $('#table-venues').DataTable({
            ajax: {
            url: "{{url('/registrar/venues/get-venues')}}",
            dataSrc: ''
            },
            responsive:true,
                "order": [[ 3, "desc" ]],
            columns: [
            { data: 'venueName'},
            { data: null,
                render:function(data){
                    return data.f_building_v.buildingName+' '+data.floor.venueFloorName;
                }
            },
            { data: null,
                render:function(data){
                    return data.f_user_v.firstName+' '+data.f_user_v.lastName;

                }
            },
            { data: 'updated_at'},
            { data: null,
                render:function(data){
                    return '<span class="badge badge-status badge-'+data.f_venue_status_v.venueStatusType.toLowerCase()+'">'+data.f_venue_status_v.venueStatusType+'</span>';

                }
            },
            
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
                        title: 'Benilde Reservation Online Services',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel" style="font-size:18px;"></i> <span style="font-size:12px;">Excel</span>',
                        titleAttr: 'EXCEL',
                        title: 'Benilde Reservation Online Services',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf" style="font-size:18px;"></i> <span style="font-size:12px;">PDF</span>',
                        titleAttr: 'PDF',
                        title: 'Benilde Reservation Online Services',
                        customize: function ( doc ) {
                            doc.content.splice( 1, 0, {
                                margin: [ 0, 0, 0, 12 ],
                                alignment: 'center',
                                image: 'data:image/png;base64,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'
                            } );
                        },
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" style="font-size:18px;"></i> <span style="font-size:12px;">Print</span>',
                        titleAttr: 'Print',
                        title: 'Benilde Reservation Online Services',
                        // customize: function ( win ) {
                        //     $(win.document.body)
                        //         .css( 'font-size', '10pt' )
                        //         .prepend(
                        //             '<center><img src="{{asset("images/icons/benilde.png")}}" style="" /></center>'
                        //         );
        
                        //     $(win.document.body).find( 'table' )
                        //         .addClass( 'compact' )
                        //         .css( 'font-size', 'inherit' );
                        // },
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
                 resetVenueImage();
                 resetEquipment();
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
                        var checker = 0;
                        if($('.file-venue-image').length == 0){
                            $('.venue-image-message').html('<span class="validate_error_message">Venue Image is required.</span>');
                             checker++;
                        } else {
                            $('.venue-image-message').html('');
                            checker--;
                        }

                        if($('.equipment_name').length == 0){
                            $('.equipment-message').html('<span class="validate_error_message">Equipment is required.</span>');
                             checker++;
                        } else {
                            $('.equipment-message').html('<span class="validate_error_message">Equipment is required.</span>');
                            // $('.equipment-message').html('');
                            checker--;
                        }

                        if(checker > 0) {
                            return false;
                        }

                        $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                        var formData = new FormData(this);
                        var equipmentStatus = [];
                        $.each($(".equipment-status option:selected"), function(){            
                            equipmentStatus.push($(this).val());
                        });
                        formData.append('equipmentStatus', JSON.stringify(equipmentStatus));
                         $.ajax({
                            url: "{{url('/registrar/venues/add-venue')}}",
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
                                        equipment_ctr = 0;
                                        resetVenueImage();
                                        resetEquipment();
                                        $('select').prop('selectedIndex', 0);
                                        $('input[type="text"]').val('');
                                      }
                                    });
                                  venues.ajax.reload();
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                        });
                        $('.btn-confirm').removeClass('disabled').html('Confirm');
                     }
            });


            $(document).on('submit', '#form-edit-venue', function(e){
                    e.preventDefault();
                        $('.validate_error_message').remove();
                        $('.required-input').removeClass('err_inputs');
                    if(validate.standard('.required-input') == 0){
                        var checker = 0;
                        if($('.file-venue-image').length == 0){
                            $('.venue-image-message').html('<span class="validate_error_message">Venue Image is required.</span>');
                             checker++;
                        } else {
                            $('.venue-image-message').html('');
                            checker--;
                        }

                        if($('.equipment_name').length == 0){
                            $('.equipment-message').html('<span class="validate_error_message">Equipment is required.</span>');
                             checker++;
                        } else {
                            $('.equipment-message').html('');
                            checker--;
                        }

                        if(checker > 0) {
                            return false;
                        }

                        $('.btn-confirm').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
                        var formData = new FormData(this);
                        var equipmentStatus = [];
                        var existingPicture = [];
                        $.each($(".equipment-status option:selected"), function(){            
                            equipmentStatus.push($(this).val());
                        });
                         $.each($(".edit-venue-image"), function(){            
                            existingPicture.push($(this).attr('data-id'));
                        });
                        formData.append('equipmentStatus', JSON.stringify(equipmentStatus));
                        formData.append('existingPicture', JSON.stringify(existingPicture));
                        var venueID = $('.btn-confirm').attr('data-id');
                        formData.append('venueID', venueID);
                         $.ajax({
                            url: "{{url('/registrar/venues/update-venue')}}",
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
                                        $('#venue-modal').modal('hide')
                                        equipment_ctr = 0;
                                        resetVenueImage();
                                        resetEquipment();
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

            // $(document).on('click', '.edit-venue-image', function(){
            //     venue_image_chk++;
            // });

            //  $(document).on('click', '.delete-venue-image', function(){
            //     venue_image_chk--;
            // });

            $(document).on('click', '.btn-edit-venue', function(){
                    var id = $(this).attr('data-id');
                    $('.btn-confirm').attr('data-id', id);
                    $('.form-venue').attr('id', 'form-edit-venue');
                    $('.validate_error_message').remove();
                    $('.required-input').removeClass('err_inputs');
                    $('.modal-venue-title').html('Edit Venue');
                     $.ajax({
                        url: "{{url('/registrar/venues/get-specific-room')}}",
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
                            var venue_ctr = 1;
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
                                html += '<div class="venue-image-parent'+venue_ctr+'">';
                                html += '<div class="input-group venue-image-preview-container'+venue_ctr+'">';
                                html +=   '<input type="file" name="venue_image[]" value="'+y.pictureName+'" class="form-control file-venue-image edit-venue-image" data-id="'+y.pictureID+'" data-ctr="'+venue_ctr+'">';
                                html += '<div class="input-group-prepend">';
                                html += '<button type="button" class="btn btn-danger btn-delete-venue-image delete-venue-image" data-ctr="'+venue_ctr+'"><i class="fas fa-trash-alt"></i></button>';
                                html += '</div></div>';
                                html += '<div class="venue-image-preview'+venue_ctr+'"><img class="venue-image my-2" src="/storage/venue images/rooms/'+y.pictureName+'"></div>';
                                html += '</div>';
                                venue_ctr++;
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
                html +=   '</div></div>';
                html += '<div class="venue-image-preview'+venue_ctr+'"></div>';
                html += '</div>';
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
                            url: "{{url('/registrar/venue/update-status')}}",
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
            });
            
            $(document).on('click', '.btn-delete-equipment', function(e){
                var ctr = $(this).attr('data-ctr');
                $('.equipment-parent'+ctr).remove();
            });

            
            $(document).on('change', '.file-venue-image', function(){
                var test = this;
                $(this).removeClass('edit-venue-image');
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
                        $('.venue-image-preview'+ctr).html(html);
                        }
                        reader.readAsDataURL(this.files[0]);
          
                      }
                  }
            });
        });
  </script>
    @endsection