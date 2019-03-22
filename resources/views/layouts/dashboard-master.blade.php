<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="BROS">
    <meta property="og:title" content="BROS">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="BROS">
    @yield('title')
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/icons/benilde.ico') }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/badge.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.css"
    />
    <!-- Font-icon css-->
    {{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @yield('css')
  </head>

  @include('layouts.partials.top-menu-dashboard')

    @include('layouts.partials.side-menu-dashboard')

    @yield('content')

    @include('layouts.partials.footer-dashboard')
    <!-- Scripts -->
    <script src="{{asset('dashboard/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('dashboard/js/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/js/main.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script> --}}
    <script src="{{asset('dashboard/js/custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script></script>
    @yield('scripts')