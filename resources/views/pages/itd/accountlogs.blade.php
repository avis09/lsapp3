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
    </main>

    @if(count($logtime) > 0)
        <div class="container">
            <table class="table">

                <tr>
                    <td>User ID </td>
                    <td>In Time </td>
                    <td>Out Time </td>
                </tr>
                @foreach($logtime as $logtimes)
                    <tr>
                        <td>{{$logtimes->f_logs->firstName}} {{$logtimes->f_logs->lastName}}</td>
                        <td>{{$logtimes->inTime}}</td>
                        <td>{{$logtimes->outTime}}</td>
                    </tr>
                @endforeach
            </table>

        </div>

    @else
        <p>No User logs found</p>
    @endif
@endsection