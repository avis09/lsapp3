@extends('layouts.dashboard-master')

@section('title')
    <title>Court Venues | Bros </title>
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
                <h1><i class="fa fa-calendar"></i> Courts List</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Venues Gallery</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2>Courts</h2>
                        <hr>
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
                                    <h3>{{$venue->venueName}}</h3>
                                </div>
                            </div>
                        @endforeach
                            </div>

                    </div>
                    </div>
                </div>
            </div>

    </main>
    

@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('slick-1.8.1/slick/slick.min.js')}}" ></script>
<script>
        $(document).ready(function () {
            $('#menu-court-gallery').addClass('active');

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
        });
    </script>
    
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-venue-courts').addClass('active');
        });
    </script>
@endsection
