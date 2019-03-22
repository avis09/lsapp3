@extends('layouts.dashboard-master')

@section('title')
    <title>GASD Reservation | Bros</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/badge.css')}}">
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .waiver-content{
            display: none;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> ITD Logtime </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">LogTime</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="logtimes-tab" data-toggle="tab" href="#logtimes-href" role="tab" aria-controls="pending-reservations-href" aria-selected="true">Pending Reservations</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="logtimes-href" role="tabpanel" aria-labelledby="logtimes-tab">
                        <div class="table-responsive">
                            <table id="table-logtime" class="table table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Venue</th>
                                    <th>Name</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td>Venue</td>
                                    <td>Name</td>
                                    <td>Time</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {{--card body--}}
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        var logs
        $(document).ready(function () {
            $('#menu-logtimes').addClass('active');
            logs = $('#table-logtime').DataTable({
                ajax: {
                    url: "/student/get-look",
                    dataSrc: ''
                },
                responsive:true,
                // "order": [[ 5, "desc" ]],
                columns: [,
                    { data: 'venue'},
                    { data: 'name'},
                    { data: 'time'},
                ],

        });
        });
    </script>
@endsection