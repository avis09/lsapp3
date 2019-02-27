@extends('layouts.app')

@section('content')

Total Number of Active Venue: {{$count}}
    {{--<h1>Venues</h1>--}}
    {{--@if(count($venues) > 0)--}}
        {{--<div class="container">--}}
            {{--<table class="table">--}}

                {{--<tr>--}}
                    {{--<td>Venue ID </td>--}}
                    {{--<td>Building </td>--}}
                {{--</tr>--}}
                {{--@foreach($venues as $venue)--}}
                    {{--<tr>--}}
                        {{--<td>{{$venue->venueID}}</td>--}}
                        {{--<td>{!!$venue->f_buildingV->buildingName!!}</td>--}}

                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--@else--}}
        {{--<p>No Venue Reports found</p>--}}
    {{--@endif--}}
@endsection