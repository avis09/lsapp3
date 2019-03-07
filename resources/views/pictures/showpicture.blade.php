@extends('layouts.app')

@section('content')
    <a href="/pictures" class="btn btn-default">Go Back</a>
    <img style="width:100%" src="/storage/cover_images/{{$picture->pictureName}}">
    <div>
        {!!$pictures->f_venue->venueName!!}
    </div>



@endsection