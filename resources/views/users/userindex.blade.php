@extends('layouts.app')

@section('content')
 <h1>Users</h1>
 <hr>

 @if(count($users) > 0)

  @foreach($users as $user)
   <div class="well">
    <a href="/users/{{$user->userID}}">{{$user->firstName}}</a>
    <div>
     {!!$user->f_department->departmentName!!}
    </div>
    <hr>
 </ol>
  @endforeach
 @else
  <p>No posts found</p>
 @endif
@endsection