@extends('layouts.app')

@section('content')
    <h1>Calendar </h1>

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
        <table class="table availSched">
            <tr>
                <td>Venue</td>
                <td>User Role</td>
                <td>First Name</td>
            </tr>
            <tr>
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

@endsection
