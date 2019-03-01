@extends('layouts.dashboard-master')

@section('title')
    <title>Users | ITD Bros</title>
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">598</span></div>
                                            <div class="stat-heading">Active Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">3</span></div>
                                            <div class="stat-heading">Students</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">5</span></div>
                                            <div class="stat-heading">Archived Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">20</span></div>
                                            <div class="stat-heading">Inactive Users </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

                <div class="clearfix"></div>
                <div class="card">
                    {{-- <button type="button" class="btn btn-success btn-add-user">Add User</button> --}}
                 <div class="card-body">
                    <div class="table-responsive">
                                <table id="table-users" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID No. </th>
                                            <th>Name</th>
                                            <th>Role </th>
                                            <th>Phone No. </th>
                                            <th>Email </th>
                                            <th>Department </th>
                                            <th>Status </th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID No. </th>
                                            <th>Name</th>
                                            <th>Role </th>
                                            <th>Phone No. </th>
                                            <th>Email </th>
                                            <th>Department </th>
                                            <th>Status </th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>

               
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>



    @endsection


    @section('scripts')

     <script type="text/javascript"> 
                 $(document).on('click', '.btn-add-user', function(){
                $('#user-modal').modal('show');
            });


        $(document).ready(function() {


          $('#table-users').DataTable({
            ajax: {
            url: "/itd/users/get-users",
            dataSrc: ''
            },
            responsive:true,
                // "order": [[ 5, "desc" ]],
            columns: [
            // { data: 'userID'},
            { data: 'f_userrole.roleType'},
            { data: null,
                render:function(data){
                    return data.firstName+' '+data.lastName;

                }
            },
            
            { data: 'phoneNumber'},
            { data: 'email'},
            { data: 'f_department.departmentName'},
            { data: 'f_userstatus.userStatusType'},
            { data: 'IDnumber'},
            // { data: 'actions'},
        
            {defaultContent: '<a href="" class="btn btn-primary">Edit</a>'}
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
          
      } );
  </script>

    @endsection