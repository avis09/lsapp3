@extends('layouts.dashboard-master')

@section('title')
    <title>Feedbacks | GASD Bros</title>
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
                <h1><i class="fa fa-certificate"></i> Court Feedbacks</h1>
                {{-- <p>A free and open source Bootstrap 4 admin template</p> --}}
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Feedbacks</a></li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-feedbacks" class="table table-striped">
                        <thead>
                        <tr>
                        <th>Comment </th>
                        <th>Date sent </th>
                        <th>Venue Name </th>
                        <th>Added by User: </th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <td>Commment </td>
                        <td>Date Sent</td>
                        <td>Venue Name</td>
                        <td>Added by User: </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

        @section('scripts')
            <script type="text/javascript">
                var feedbacks;
                $(document).ready(function() {
                    $('#menu-feedbacks').addClass('active');
                    feedbacks = $('#table-feedbacks').DataTable({
                        ajax: {
                            url: "/gasd/feedbacks/get-feedbacks",
                            dataSrc: ''
                        },
                        responsive:true,
                        // "order": [[ 5, "desc" ]],
                        columns: [
                            // { data: 'userID'},

                            { data: 'comment'},
                            { data: 'created_at'},
                            { data: 'f_venue.venueName'},
                            { data: null,
                                render:function(data){
                                    return data.f_user.firstName+' '+data.f_user.lastName;

                                }
                            }
                            // { defaultContent: ""}
                        ],
                        //Start of data tables button
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
