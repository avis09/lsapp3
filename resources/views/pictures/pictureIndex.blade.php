@extends('layouts.app')

@section('content')
    <h1>Venues With Picture</h1>
    <hr>

    @if(count($picture) > 0)

        @foreach($picture as $pic)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">

                        <img style="width:100%" src="/storage/cover_images/{{$pic->pictureName}}">
                        <hr>
                    </div>
                </div>
            </div>
        @endforeach
    @else
                    <p>No posts found</p>
    @endif

@endsection