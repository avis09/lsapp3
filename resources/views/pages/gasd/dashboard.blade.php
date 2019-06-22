@extends('layouts.dashboard-master')

@section('title')
<title>Dashboard | GASD BROS</title>
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
      <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6 col-lg-4">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Schedules Count</h4>
          <p><b>{{$countAllSchedules}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Total number of Courts</h4>
          <p><b>{{$countAllTotalRooms}}</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>active Court</h4>
          <p><b>{{$countAllActiveRooms}}</b></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h4>Feedbacks</h4>
          <div class="table-responsive mt-3">
            <table id="table-feedbacks" class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Court</th>
                  <th>Message</th>
                  <th>Date Received </th>
                </tr>
              </thead>
              <tbody>
                @foreach($feedbacks as $feedback)
                <tr>
                  <td>{{$feedback->f_user->firstName.' '.$feedback->f_user->lastName}}</td>
                  <td>{{$feedback->f_venue->venueName}}</td>
                  <td>{{$feedback->comment}}</td>
                  <td>{{$feedback->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="text-center"><a href="/gasd/feedbacks" type="button" class="btn btn-primary btn-sm">View More</a></div>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card">
        <div class="card-body">
          <h4>Reservation Requests</h4>
          <div class="table-responsive mt-3">
            <table id="table-reservations" class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Court</th>
                  <th>Purpose</th>
                  <th>Schedule</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reservations as $reservation)
                <tr>
                  <td>{{$reservation->user->firstName.' '.$reservation->user->lastName}}</td>
                  <td>{{$reservation->f_venue->venueName}}</td>
                  <td>{{$reservation->purpose}}</td>
                  <td>{{$reservation->date.' ('.$reservation->f_time->timeStartTime.' - '.$reservation->f_time->timeEndTime.')'}}</td>
                  <td><span class="badge badge-status badge-{{strtolower($reservation->reservationStatus->statusName)}}">{{$reservation->reservationStatus->statusName}}</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="text-center"><a href="/gasd/schedules/list" type="button" class="btn btn-primary btn-sm">View More</a></div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection

@section('scripts')
<script type="text/javascript"> 

  $(document).ready(function() {
    $('#menu-dashboard').addClass('active');
  });
</script>

@endsection
