@extends('layouts.app')

@section('content')
    <h1>Feedbacks</h1>


    @if(count($feedbacks) > 0)
    <div class="container">
        <table class="table">
            <tr>
                <td>Feedback ID</td>
                <td>Comment </td>
                <td>Date sent </td>
                <td>Venue Name </td>
                <td>Added by User: </td>
            </tr>
            @foreach($feedbacks as $feedback)
                <tr>
                    <td>{{$feedback->feedbackID}}</td>
                    <td>{{$feedback->comment}}</td>
                    <td>{{$feedback->created_at}}</td>
                    <td>{!!$feedback->venueName!!}</td>
                    <td>{!!$feedback->userID!!} </td>
                </tr>
            @endforeach
        </table>

    </div>

    @else
        <p>No Feedback found</p>
    @endif
@endsection
