@extends('layouts.app')

@section('content')
    <h1>User Log time</h1>

    {{--<a href="/users/{{$user->userID}}/edit">EDIT</a>--}}
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