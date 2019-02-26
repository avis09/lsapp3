@extends('layouts.app')

@section('content')
    <h1>Feedbacks</h1>


    @if(count($feedbacks) > 0)
        <div class="container">
            <table class="table">
                <tr>
                    <td>Comment </td>
                    <td>Date sent </td>
                    <td>Venue Name </td>
                    <td>Venue ID </td>
                    <td>Added by User: </td>
                </tr>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{$feedback->comment}}</td>
                        <td>{{$feedback->created_at}}</td>
                        <td>{!!$feedback->f_venue->venueName!!}</td>
                        <td>{!!$feedback->venueID!!}</td>
                        <td>{!!$feedback->f_user->firstName!!}  {!!$feedback->f_user->lastName!!}</td>
                    </tr>
                @endforeach
            </table>

        </div>

    @else
        <p>No Feedback found</p>
    @endif
@endsection
