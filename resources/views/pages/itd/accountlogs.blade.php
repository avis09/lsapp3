@extends('layouts.dashboard-master')

@section('title')
    <title>Account Logs | ITD Bros</title>
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
                <h1><i class="fa fa-dashboard"></i> Account Logs</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Account</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
                    @if(count($logtime) > 0)
                    <div class="container">
                            <table id="table-venues" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>In Time </th>
                                <th>Out Time </th>
                            </tr>
                        </thead>
                        <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>In Time </th>
                                    <th>Out Time </th>
                                </tr>
                            </tfoot>
                        <tbody>
                            @foreach($logtime as $logtimes)
                                <tr>
                                    <td>{{$logtimes->f_logs->firstName}} {{$logtimes->f_logs->lastName}}</td>
                                    <td>{{$logtimes->inTime}}</td>
                                    <td>{{$logtimes->outTime}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>

                    </div>

                @else
                    <p>No User logs found</p>
                @endif
            </div>
        </div>
    </main>

@endsection