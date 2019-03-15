@extends('layouts.dashboard-master')

@section('title')
    <title>Users | Bros</title>
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
                                        •	<strong> Step 1: </strong> Select “Reservation” tab <br>
                                        •	<strong> Step 2: </strong> Click “Calendar” button found in the dropdown <br>
                                        •	<strong> Step 3: </strong> After redirection, fill-in the required fields (Venue Type, Venue, and Date) <br>
                                        •	<strong> Step 4: </strong> If there is a reservation in the chosen date, the application will display the time and date that is reserved <br>
                                        •	<strong> Step 5: </strong> The user can also view all time slots available for the chosen date. <br>
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
                                        •	<strong>Step 2: </strong> A dropdown will appear that consists of Rooms or Courts <br>
                                        •	<strong>Step 3: </strong> After selecting a room/venue, the application will redirect the user to the gallery and details of the room/venue <br>
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
                                    •	<strong> Step 1: </strong> Select “Reservation” button <br>
                                    •	<strong> Step 2: </strong> A dropdown will appear, and user must select “Reserve List” button <br>
                                    •	<strong> Step 3: </strong> Click “Add Reservation” and fill-in the necessary required fields (Venue Type, Venue, Purpose, Schedule Date, and Time) <br>
                                    •	<strong> Step 4: </strong> If a user reserves a room, he/she only needs to reserve an available time in able to schedule. <br>
                                    •	<strong> Step 5: </strong> If a user reserves a court, the user must answer a waiver form (asking for the names and ID numbers of the people involved) in able to proceed to reservation. <br>
                                    •	<strong> Step 6: </strong> Select “Confirm” button <br>
                                    •	<strong> Step 7: </strong> Wait for the administrator’s approval regarding the reservation <br>
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
                                    •	<strong>Step 2: </strong> Select “Reservation List” button after the dropdown appears <br>
                                    •	<strong>Step 3: </strong> See your reservation/s <br>
                                    •	<strong>Step 4: </strong> Under the “Action” column, the user can click the “cancel” button regarding their reservation <br>
                                    •	<strong>Step 5: </strong> Click "Yes", and the reservation will be cancelled <br>
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
                                    •	<strong>Step 2: </strong> Fill-up the required fields (Venue Type, Venue, and Comment) <br>
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


