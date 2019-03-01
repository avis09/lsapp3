@extends('layouts.app')

@section('content')
    <h1>Add Picture</h1>



    {!! Form::open(['action' => 'PictureController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}

    <label for="venues">Venues</label>
    <select class="form-control" name="venueID" id="venueID" data-parsley-required="true">
        @foreach ($venueI['venue'] as $venueIs)
            {
            <option value="{{ $venueIs->venueID }}">{{ $venueIs->venueName  }}</option>
            }
        @endforeach
    </select>
    <div class="form-group">


        {{Form::file('pictureName')}}
        </div>



    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection