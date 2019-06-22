@extends('layouts.dashboard-master')

@section('title')
    <title>FAQs | BROS</title>
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
                                        How to display calendar?
                                    </h5>
                                  </div>

                                  <div id="faq1" class="collapse" aria-labelledby="heading1">
                                    <div class="card-body">
                                        •	<strong>Step 1: </strong> Select “Calendar” button under the dropdown-item of “Reservation” tab found in the navbar. <br>
                                        •	<strong>Step 2: </strong> View the calendar by clicking the date button textbox <br>
                                        •	<strong>Step 3: </strong> Select a given date <br>
                                        •	<strong>Step 4: </strong> If there is a reservation in the chosen date, the application will display the time and date that is reserved <br>
                                        •	<strong>Step 5: </strong> View the reserved room and time of the given date. <br>
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">
    
                                <div class="card">
                                  <div class="card-header  card-header-accordion card-faq" id="heading2"  data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                    <h5 class="faq-question mb-0">
                                        How to view venues, venue details, and venue gallery?
                                    </h5>
                                  </div>

                                  <div id="faq2" class="collapse" aria-labelledby="heading2">
                                    <div class="card-body">
                                        •	<strong>Step 1: </strong> Select “Venues Gallery” button found in the navbar <br>
                                        •	<strong>Step 2: </strong> Choose a specific venue,  and the details and equipment of it will be shown to you. <br>
                                        •	<strong>Step 3: </strong> See the time slots available for the venue <br>
                                    </div>
                                  </div>
                                </div>
                        </div>
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading3"  data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq1">
                                <h5 class="faq-question mb-0">
                                    Reserve a venue
                                </h5>
                            </div>

                            <div id="faq3" class="collapse" aria-labelledby="heading3">
                                <div class="card-body">
                                    •	Step 1: Select “Reservation” button <br>
                                    •	Step 2: A dropdown will appear, and user must select “Reserve Venue” button <br>
                                    •	Step 3: If a user reserves a room, he/she only needs to reserve an available time in able to schedule.
                                    •	Step 4: If a user reserves a court, a “terms & conditions” or “waiver” must be accepted by the user in able to proceed to reservation.
                                    •	Step 5: Select “Reserve” button
                                    •	Step 6: Wait for the administrator’s approval regarding the reservation
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading4"  data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq1">
                                <h5 class="faq-question mb-0">
                                    Cancel a Reservation
                                </h5>
                            </div>

                            <div id="faq4" class="collapse" aria-labelledby="heading4">
                                <div class="card-body">
                                    •	<strong>Step 1: </strong> Select “Reservation” button <br>
                                    •	<strong>Step 2: </strong> Select “Reservations” button after the dropdown appears <br>
                                    •	<strong>Step 3: </strong> See your reservation/s <br>
                                    •	<strong>Step 4: </strong> Click a “cancel” button regarding their reservation <br>
                                    •	<strong>Step 5: </strong> The reservation will be cancelled <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="faq-section" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header  card-header-accordion card-faq" id="heading5"  data-toggle="collapse" data-target="#faq5" aria-expanded="true" aria-controls="faq1">
                                <h5 class="faq-question mb-0">
                                    Send Feedback
                                </h5>
                            </div>

                            <div id="faq5" class="collapse" aria-labelledby="heading5">
                                <div class="card-body">
                                    •	<strong>Step 1: </strong> Select “Send Feedback” under the Feedbacks button <br>
                                    •	<strong>Step 2: </strong> Fill-up the comment section <br>
                                    •	<strong>Step 3: </strong> Click “Submit” button <br>
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
            $('#menu-faqs').addClass('active'); 
        });
    </script>
    @endsection


