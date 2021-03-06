@extends('layouts.dashboard-master')

@section('title')
    <title>Active Users | ITD Bros</title>
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
                <h1><i class="fa fa-dashboard"></i> Active Users</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Active</a></li>
            </ul>
        </div>
    </main>>
        @endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#active-users').addClass('active');
        });
    </script>
@endsection
