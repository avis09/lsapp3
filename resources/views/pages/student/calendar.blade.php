@extends('layouts.dashboard-master')

@section('title')
    <title>Calendar | Bros </title>
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
                <h1><i class="fa fa-calendar"></i> Calendar</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Calendar</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
                    
    <label for="venue">Venue:</label>
    <select class="form-control" name="venue" id="venue" data-parsley-required="true">
        @foreach ($venues as $venue)
            {
            <option value="{{ $venue->venueID }}">{{ $venue->venueName }}</option>
            }
        @endforeach
    </select>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            {!! Form::label('date', 'Date:') !!}
            <div class="">
                {!! Form::date('date','', ['class' => 'form-control']) !!}
                {!! $errors->first('date', '<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
    </div>


    <div class="container">
        <table class="table">
            <tr>
                <td>Date</td>
                <td>Time</td>
                <td>Status</td>
                <td>Reserved By</td>
            </tr>
        </table>
        <table class="table availSched">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            {{--@foreach($users as $user)--}}
            {{--<tr>--}}
            {{--<td>{{$user->userID}}</td>--}}
            {{--<td>{{$user->userRoleID}}</td>--}}
            {{--<td>{{$user->firstName}}</td>--}}
            {{--<td>--}}
            {{--<a href="/users/{{$user->userID}}/edit">EDIT</a>--}}
            {{--<td><a href="{{ route('users.edit',$user->userID)}}" class="btn btn-primary">Edit</a></td>--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
        </table>
    </div>
                    </div>
            </div>

    </main>
    

@endsection

@section('scripts')
<script>
        $(document).ready(function () {
            $(document).on('change', function () {
    
                // console.log('changed');
                var venueID = $('#venue').val();
                var date = $('#date').val();
                // console.log(Floor_Id);
                var div = $('.sched');
                var op = " ";
    
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('findVenueSched') !!}',
                    data: {'venueID': venueID, 'date': date},
                    success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                            op += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';
                        }
                        if(data.length == 0){
                            op += '<option selected for="time" value="" disabled selected>No time available</option>';
                        }
                        $(div).html(" ");
                        $(div).append(op);
                    },
                    error: function () {
                        console.log('error');
                    }
                })
            })
        });
    </script>
    
    <script>
        $(document).ready(function () {
            $(document).on('change', function () {
    
                // console.log('changed');
                var venueID = $('#venue').val();
                var date = $('#date').val();
                // console.log(Floor_Id);
                var table = $('.availSched');
                var op = " ";
    
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('showSchedules') !!}',
                    data: {'venueID': venueID, 'date': date},
                    success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                            op += '<tr> + <td>' + data[i].date + '</td> + <td>' + data[i].timeStartTime + '-' + data[i].timeEndTime + '</td> + <td>' + data[i].statusName + '</td> + <td>' + data[i].firstName + '</td> + <tr>';
                        }
                        if(data.length == 0){
                            op += '<option selected for="time" value="" disabled selected>No reservations</option>';
                        }
                        $(table).html(" ");
                        $(table).append(op);
                    },
                    error: function () {
                        console.log('error');
                    }
                })
            })
        });
    </script>
    
@endsection