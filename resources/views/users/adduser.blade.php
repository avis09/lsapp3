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

        {{Form::label('firstName', 'First Name')}}
        {{Form::text('firstName', '', ['class' => 'form-control', 'placeholder'
        => 'First Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('LastName', 'Last Name')}}
        {{Form::text('LastName', '', ['class' => 'form-control', 'placeholder'
        => 'Last Name'])}}
    </div>

    {{--status should always be active--}}
    {{--User Status ID--}}
    {{--{{Form::label('Status', 'Status')}}--}}
    {{--{{Form::text('Status', '', ['class' => 'form-control', 'placeholder'--}}
    {{--=> 'Status'])}}--}}
    {{--<select class="form-control" name="userstatus" id="userstatus" data-parsley-required="true">--}}
        {{--@foreach ($userSs['userstatus'] as $userS)--}}
            {{--{--}}
            {{--<option value="{{ $userS->userStatusID }}">{{ $userS->userStatusType }}</option>--}}
            {{--}--}}
            {{--@endforeach--}}
    {{--</select>--}}

    <div class="form-group">
        {{Form::label('password', 'Password')}}
        {{ Form::password('password', array('id' => 'password', "class" => "form-control", "autocomplete" => "off")) }}
    </div>

    <div class="form-group">
        {{Form::label('phoneNumber', 'Phone Number')}}
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
    {{Form::label('department', 'Department')}}
    <select class="form-control" name="department" id="department" data-parsley-required="true">
        @foreach ($userDs['department'] as $userD)
            {
        <option value="{{ $userD->departmentID }}">{{ $userD->departmentName }}</option>
            }
            @endforeach
    </select>

    {{--ID number--}}
    <div class="form-group">
        {{Form::label('idnumber', 'IDnumber')}}
        {{Form::number('IDnumber', '',['class' => 'form-control', 'placeholder'
        => 'ID number'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection