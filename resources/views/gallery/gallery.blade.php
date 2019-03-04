@extends('layouts.app')

@section('content')
    <h1>Gallery</h1>


    @if(count($venue) > 0)
        <div class="container">
            <table class="table">
                <tr>
                    <td>Feedback ID</td>
                    <td>EquipmentID </td>
                    <td>Pictures</td>
                </tr>
                @foreach($venue as $venues)
                    <tr>
                        <td>{{$venues->venueID}}</td>
                        <td>{{$venues->pictureID}}</td>
                        {{--<td> <img style="width:100%" src="/storage/cover_images/{{$picture->pictureName}}"></td>--}}
                        {{--<td>{{$venue->pictureID}}</td>--}}
                    </tr>
                @endforeach
            </table>

        </div>

    @else
        <p>Gallery empty</p>
    @endif
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<h1>Venue Gallery</h1>--}}



    {{--<label for="venues">Venue </label>--}}
    {{--<select class="form-control" name="venueFloorID" id="venueFloorID" data-parsley-required="true">--}}
        {{--@foreach ($venueF['venuefloor'] as $venueFs)--}}
            {{--{--}}
            {{--<option value="{{ $venueFs->venueFloorID }}">{{ $venueFs->venueFloorName }}</option>--}}
            {{--}--}}
        {{--@endforeach--}}
    {{--</select>--}}


    {{--{!! Form::open(['action' => 'VenuesController@store', 'method' => 'POST' ,--}}
     {{--'enctype' => 'multipart/form-data']) !!}--}}


    {{--{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}--}}
    {{--{!! ! Form::close() !!}--}}


{{--@endsection--}}