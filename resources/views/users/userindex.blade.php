@extends('layouts.app')

@section('content')
 <h1>Users</h1>


 @if(count($users) > 0)

  {{--@foreach($users as $user)--}}
   {{--<div class="well">--}}
    {{--<a href="/users/{{$user->userID}}">{{$user->firstName}}</a>--}}
    {{--<div>--}}
     {{--{!!$user->f_department->departmentName!!}--}}
    {{--</div>--}}
    {{--<hr>--}}
 {{--</div>--}}
  {{--@endforeach--}}
<div class="container">
    <table class="table">

     <tr>
      <td>User ID </td>
      <td>User Role </td>
      <td>First Name </td>
      <td>Last Name </td>
      <td>Phone Number </td>
      <td>Email </td>
      <td>Department </td>
      <td>Status </td>
      <td>ID number </td>
     </tr>
     @foreach($users as $user)
     <tr>
      <td>{{$user->userID}}</td>
      <td>{{$user->f_userrole->roleType}}</td>
      <td>{{$user->firstName}}</td>
      <td>{{$user->lastName}}</td>
      <td>{{$user->phoneNumber}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->f_department->departmentName}}</td>
      <td>{{$user->f_userstatus->userStatusType}}</td>
      <td>{{$user->IDnumber}}</td>
      <td>
       {{--<a href="/users/{{$user->userID}}/edit">EDIT</a>--}}
      <td><a href="{{ route('users.edit',$user->userID)}}" class="btn btn-primary">Edit</a></td>
      </td>
     </tr>
     @endforeach
    </table>

</div>

 @else
  <p>No Users found</p>
 @endif
@endsection