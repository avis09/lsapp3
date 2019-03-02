<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>



<script>
    $(document).ready(function () {
        $(document).on('change', function () {

            // console.log('changed');
            var venueID = $('#venue').val();
            var date = $('#date').val();
            // console.log(Floor_Id);
            var div = $('.sched');
            var op = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('findVenueSched') !!}',
                data: {'venueID': venueID, 'date': date},
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                        op += '<option for="time" value="' +data[i].timeID+ '">'+ data[i].timeStartTime + '-' + data[i].timeEndTime +'</option>';
                    }
                    if(data.length == 0){
                        op += '<option selected for="time" value="" disabled selected>No time available</option>';
                    }
                    $(div).html(" ");
                    $(div).append(op);
                },
                error: function () {
                    console.log('error');
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('change', function () {

            // console.log('changed');
            var venueID = $('#venue').val();
            var date = $('#date').val();
            // console.log(Floor_Id);
            var table = $('.availSched');
            var op = " ";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('showSchedules') !!}',
                data: {'venueID': venueID, 'date': date},
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        //op += '<option selected for="time" value="" disabled>Select a time now</option>';
                        op += '<tr> + <td>' + data[i].date + '</td> + <td>' + data[i].timeStartTime + '-' + data[i].timeEndTime + '</td> + <td>' + data[i].statusName + '</td> + <tr>';
                    }
                    if(data.length == 0){
                        op += '<option selected for="time" value="" disabled selected>No reservations</option>';
                    }
                    $(table).html(" ");
                    $(table).append(op);
                },
                error: function () {
                    console.log('error');
                }
            })
        })
    });
</script>
</html>
