@extends('layouts.dashboard-master')

@section('title')
    <title>Room Gallery | Registrar BROS </title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .venue-image{
            height: 280px;
            width:100%;
        }
        .slider-container{
            margin-top: 30px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('slick-1.8.1/slick/slick.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('slick-1.8.1/slick/slick-theme.css')}}"/>


@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar"></i> Room Gallery</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Room Gallery</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2>ROOMS</h2>
                        <h3></h3>
                        <div class="row slider-container mt-5">
                        @foreach($venues as $venue)
                            <div class="col-md-4">
                                <div class="regular slider">
                                @foreach($venue->pictures as $picture)
                                    <div>
                                        <img class="venue-image" src="/storage/venue images/rooms/{{$picture->pictureName}}">
                                    </div>
                                @endforeach
                                </div>
                                <div class="text-center venue-title">
                                    <h4>{{$venue->venueName}}</h4>
                                    <p><b>Capacity: {{$venue->venueCapacity}}</b></p>
                                    <button type="button" class="btn btn-primary btn-view-equipments mt-3" data-id="{{$venue->venueID}}">View Equipments</button>
                                </div>
                            </div>
                        @endforeach
                            </div>

                    </div>
                    </div>
                </div>
            </div>

    </main>
    

    <div class="modal fade" id="equipments-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title modal-venue-title" id="smallmodalLabel">Room Equipments</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    <div class="modal-body">
                       <div class="equipments-container">
                            <div class="table-responsive">
                                <table id="table-equipments" class="table table-striped hidden">
                                    <thead>
                                    <tr>
                                        <th>Equipment Name</th>
                                        <th>Barcode</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody-equipments">
                                        
                                    </tbody>
                                </table>
                            </div>
                       </div>
                    </div>
                    <div class="modal-footer text-right">
                    </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('slick-1.8.1/slick/slick.min.js')}}" ></script>
<script>
        $(document).ready(function () {
            $('#menu-regroomreservation').addClass('is-expanded');
            $('#menu-room-gallery').addClass('active');
                $('.regular').slick({
                    // prevArrow: false,
                    // nextArrow: false,
                    dots: true,
                    // customPaging: function(slider, i) {
                    // var thumb = $(slider.$slides[i]).data();
                    //     return '<div class="customdot"></div>';
                    // },
                    infinite: true,
                        autoplay: true,
                        autoplaySpeed: 3000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                // infinite: true,
                                // dots: false
                            }
                        },
                        {
                            breakpoint: 720,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });

                $(document).on('click', '.btn-view-equipments', function(){
                    var id = $(this).attr('data-id');
                     $.ajax({
                        url: "/registrar/venues/get-room-equipments",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id
                        },
                        success:function(data){
                           $('#equipments-modal').modal('show');
                           if(data.length > 0){
                               var rows = '';
                               $.each(data, function(x,y){
                                rows +='<tr>';
                                rows +='<td>'+y.equipmentName+'</td>';
                                rows +='<td>'+y.barCode+'</td>';
                                rows +='<td><span class="badge badge-status badge-'+y.f_equipment_status.equipmentStatusName.toLowerCase()+'">'+y.f_equipment_status.equipmentStatusName+'</span></td>';
                                rows +='<tr>';
                               });
                              $('.tbody-equipments').html(rows);
                            }
                            else{
                                var message = "<h5 class='text-center mt-2'>No equipments for this room</h5>";
                              $('#table-equipments').html(message);   
                            }

                           $('#table-equipments').show();
                        }
                    });
            });

        });
    </script>
@endsection