@extends('layouts.app')

@section('content')
    <a href="/feedbacks" class="btn btn-default">Go Back</a>
    <h1>{{$feedbacks->comment}}</h1>
    <div>
        {!! $feedbacks->f_venueFB->venueName !!}
    </div>
    <div>
        {!!$feedbacks->f_userF->firstName!!}
    </div>
    <a href="/venues/{{$feedbacks->userID}}/edit" class="btn btn-default">Edit</a>


@endsection