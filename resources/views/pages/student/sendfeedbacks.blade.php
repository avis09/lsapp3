@extends('layouts.dashboard-master')

@section('title')
    <title>Send Feedback | Bros</title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-certificate"></i> Send Feedback </h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Active</a></li>
            </ul>
        </div>
        <div class="card">
                <div class="card-body">
        <form action="student/feedbacks/create" method="POST">
            <div class="form-group">
                <label for="venues">Choose Venue</label>
                <select class="form-control" name="f_venue" id="f_venue" data-parsley-required="true">
                    @foreach ($f_venue as $f_venues)
                        {
                            <option value="{{ $f_venues->venueID }}"> {{ $f_venues->venueName }}</option>
                        }
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Comment <span class="required">*</span></label>
                <input type="text" class="form-control" name="comment">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
</div>
</main>
@endsection