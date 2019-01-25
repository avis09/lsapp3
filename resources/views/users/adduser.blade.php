@extends('layouts.app')

@section('content')
    <h1>Add User</h1>



    {!! Form::open(['action' => 'Auth\UsersController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">


        {{--User Role ID--}}
        <select class="form-control" name="userrole" id="userrole" data-parsley-required="true">
            @foreach ($userRs['userrole'] as $userR)
                {
                <option value="{{ $userR->userRoleID }}">{{ $userR->roleType }}</option>
                }
            @endforeach
        </select>

        {{Form::label('firstName', 'firstName')}}
        {{Form::text('firstName', '', ['class' => 'form-control', 'placeholder'
        => 'First Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('LastName', 'LastName')}}
        {{Form::text('LastName', '', ['class' => 'form-control', 'placeholder'
        => 'Last Name'])}}
    </div>

    {{--User Status ID--}}
    <select class="form-control" name="userstatus" id="userstatus" data-parsley-required="true">
        @foreach ($userSs['userstatus'] as $userS)
            {
            <option value="{{ $userS->userStatusID }}">{{ $userS->userStatusType }}</option>
            }
            @endforeach
    </select>

    <div class="form-group">
        {{Form::label('Password', 'Password')}}
        {{Form::text('Password', '', ['class' => 'form-control', 'placeholder'
        => 'Password'])}}
    </div>

    <div class="form-group">
        {{Form::label('phoneNumber', 'phoneNumber')}}
        {{Form::text('phoneNumber', '', ['class' => 'form-control', 'placeholder'
        => 'Phone Number'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', '', ['class' => 'form-control', 'placeholder'
        => 'Email'])}}
    </div>

{{--apiToken--}}


    {{--<label for="venues">Venues</label>--}}
    {{--<select class="form-control" name="venues" id="venues" data-parsley-required="true">--}}
        {{--@foreach ($venues as $venue)--}}
            {{--{--}}
            {{--<option value="{{ $venue->venueID }}">{{ $venue->venueName }}</option>--}}
            {{--}--}}
        {{--@endforeach--}}
    {{--</select>--}}


    {{--departmentID--}}
    <select class="form-control" name="department" id="department" data-parsley-required="true">
        @foreach ($userDs['department'] as $userD)
            {
        <option value="{{ $userD->departmentID }}">{{ $userD->departmentName }}</option>
            }
            @endforeach
    </select>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection