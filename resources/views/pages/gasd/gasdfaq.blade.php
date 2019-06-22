@extends('layouts.dashboard-master')

@section('title')
    <title>FAQs | GASD Bros</title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .card-faq{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> FAQs</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">FAQs</a></li>
            </ul>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading1"  data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                <h5 class="faq-question mb-0">
                                    View Feedbacks
                                </h5>
                            </div>

                            <div id="faq1" class="collapse" aria-labelledby="heading1">
                                <div class="card-body">
                                    •	<strong>Step 1: </strong>  Select “Feedback” button <br>
                                    •	<strong>Step 2: </strong>  View the feedbacks sent by the students/staffs. <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading2"  data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                <h5 class="faq-question mb-0">
                                    View Reservation Reports
                                </h5>
                            </div>

                            <div id="faq2" class="collapse" aria-labelledby="heading2">
                                <div class="card-body">
                                    •	<strong>Step 1: </strong> Select “Dashboard” button <br>
                                    •	<strong>Step 2: </strong> Select a specific room/venue <br>
                                    •	<strong>Step 3: </strong> Select a date <br>
                                    •	<strong>Step 4: </strong> The reserved rooms/venues will be shown in the dashboard <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading3"  data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq1">
                                <h5 class="faq-question mb-0">
                                    Cancel a reservation
                                </h5>
                            </div>

                            <div id="faq3" class="collapse" aria-labelledby="heading3">
                                <div class="card-body">
                                    •	<strong>Step 1: </strong> Select a venue that’s been already reserved <br>
                                    •	<strong>Step 2: </strong> Click “Cancel” button beside the reserved venue found in the Reservation Requests <br>
                                    •	<strong>Step 3: </strong> Successfully cancel a reserved venue <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </main>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#menu-gasdfaq').addClass('active');
        });
    </script>
@endsection


