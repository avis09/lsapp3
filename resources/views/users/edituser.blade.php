@extends('layouts.app')

@section('content')
    <h1>Edit User Info</h1>
    <div class="form-group">
    {!! Form::open(['action' => ['Auth\UsersController@update', $users->userID],
     'method' => 'POST']) !!}
    <select class="form-control" name="userrole" id="userrole" data-parsley-required="true">
        @foreach ($userRs['userrole'] as $userR)
            {
            <option value="{{ $userR->userRoleID }}">{{ $userR->roleType }}</option>
            }
        @endforeach
    </select>


            {{Form::label('name', 'Name')}}
            {{Form::text('firstName', $users->firstName, ['class' => 'form-control', 'placeholder'
            => 'First Name'])}}

    </div>
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('LastName', $users->lastName, ['class' => 'form-control', 'placeholder'
        => 'Last Name'])}}
    </div>
    <select class="form-control" name="userstatus" id="userstatus" data-parsley-required="true">
        @foreach ($userSs['userstatus'] as $userS)
            {
            <option value="{{ $userS->userStatusID }}">{{ $userS->userStatusType }}</option>
            }
        @endforeach
    </select>

    <div class="form-group">
        {{Form::label('Password', 'Password')}}
        {{--{{Form::text('Password', '', ['class' => 'form-control', 'placeholder'--}}
        {{--=> 'Password'])}}--}}


        {{ Form::password('Password', array('id' => 'password', "class" => "form-control", "autocomplete" => "off")) }}
    </div>
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('phoneNumber', $users->phoneNumber, ['class' => 'form-control', 'placeholder'
        => 'Phone Number'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', $users->email, ['class' => 'form-control', 'placeholder'
        => 'Email'])}}
    </div>
    <select class="form-control" name="department" id="department" data-parsley-required="true">
        @foreach ($userDs['department'] as $userD)
            {
            <option value="{{ $userD->departmentID }}">{{ $userD->departmentName }}</option>
            }
        @endforeach
    </select>
    <div class="form-group">
        {{Form::label('idnumber', 'IDnumber')}}
        {{Form::text('IDnumber', $users->IDnumber, ['class' => 'form-control', 'placeholder'
        => 'ID number'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection