@extends('layouts.dashboard-master')

@section('title')
    <title>GASD Reservation | Bros</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/badge.css')}}">
    <style>
        .modal-title{
            font-size: 18px;
            font-weight: 500;
        }
        .waiver-content{
            display: none;
        }
    </style>
@endsection

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> ITD Logtime </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">LogTime</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="logtimes-tab" data-toggle="tab" href="#logtimes-href" role="tab" aria-controls="pending-reservations-href" aria-selected="true">Pending Reservations</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="logtimes-href" role="tabpanel" aria-labelledby="logtimes-tab">
                        <div class="table-responsive">
                            <table id="table-logtime" class="table table-striped w-100">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>In Time</th>
                                    <th>Out Time </th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td>Name</td>
                                    <td>In Time</td>
                                    <td>Out Time </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {{--card body--}}
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        var logs
        $(document).ready(function () {
            $('#menu-logtimes').addClass('active');
            logs = $('#table-logtime').DataTable({
                ajax: {
                    url: "/itd/accountlogs/get-logs",
                    dataSrc: ''
                },
                responsive:true,
                // "order": [[ 5, "desc" ]],
                columns: [
                    { data: null,
                        render:function(data){
                            return data.f_logs.firstName+' '+data.f_logs.lastName;

                        }
                    },
                    { data: 'inTime'},
                    { data: 'outTime'},
                ],
                dom:'B<"clear">lfrtip',
                "lengthMenu": [[10, 25, 50, 100, 300, 500, 700,1000,-1], [10, 25, 50,100, 300, 500,700,1000, "ALL"]],
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy" style="font-size:18px;"></i> <span style="font-size:12px;">Copy</span>',
                        titleAttr: 'Copy',
                        title: 'Copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel" style="font-size:18px;"></i> <span style="font-size:12px;">Excel</span>',
                        titleAttr: 'EXCEL',
                        title: 'EXCEL',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },

                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf" style="font-size:18px;"></i> <span style="font-size:12px;">PDF</span>',
                        titleAttr: 'PDF',
                        title: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" style="font-size:18px;"></i> <span style="font-size:12px;">Print</span>',
                        titleAttr: 'Print',
                        title: 'Sales Report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-eye-slash" style="font-size:18px;"></i> <span style="font-size:12px;">Columns</span>',
                        titleAttr: 'Column Visibility',
                    }]
            });

        });
    </script>
@endsection