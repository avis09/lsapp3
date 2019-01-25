@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-default">Go Back</a>

    <div>
        {!!$users->firstName!!}
    </div>
    <div>
        {!!$users->f_department->departmentName!!}
    </div>
    <a href="/users/{{$users->userID}}/edit" class="btn btn-default">Edit</a>


@endsection