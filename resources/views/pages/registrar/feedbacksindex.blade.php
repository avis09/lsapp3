@extends('layouts.dashboard-master')

@section('title')
    <title>Registrar Venues | ITD Bros</title>
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
                <h1><i class="fa fa-certificate"></i> Room Feedbacks</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Rooms</a></li>
            </ul>
        </div>

    @if(count($feedbacks) > 0)
    <div class="container">
        <table class="table">
            <tr>
                <td>Feedback ID</td>
                <td>Comment </td>
                <td>Date sent </td>
                <td>Venue Name </td>
                <td>Added by User: </td>
            </tr>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{$feedback->feedbackID}}</td>
                    <td>{{$feedback->comment}}</td>
                    <td>{{$feedback->created_at}}</td>
                    <td>{!!$feedback->venueName!!}</td>
                    <td>{!!$feedback->firstName!!} </td>
                </tr>
            @endforeach
        </table>

    </div>

    @else
        <p>No Feedback found</p>
    @endif
@endsection
