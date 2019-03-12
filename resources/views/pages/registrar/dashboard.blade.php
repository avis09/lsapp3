@extends('layouts.dashboard-master')

@section('title')
    <title>Users | ITD Bros</title>
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
          <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Students</h4>
                <p><b>5</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Active Users</h4>
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
        </div>

                        <div class="row">
                            <div class="col-md-6">
                                    <div class="card">
                                            <div class="card-body">
                                        <h4>Feedbacks</h4>
                                    <div class="table-responsive mt-3">
                                            <table id="table-feedbacks" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Message</th>
                                                        <th>Date Received </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                            </div>
                        </div>
         
                   
                        </div>
                </div>
            </main>

    @endsection

    @section('scripts')
     <script type="text/javascript"> 
        var users;
        $(document).ready(function() {
            $('#menu-dashboard').addClass('active');
        });
  </script>

    @endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $('#active-users').addClass('active');
        });
    </script>
@endsection
