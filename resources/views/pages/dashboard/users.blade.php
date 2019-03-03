@extends('layouts.dashboard-master')

@section('title')
    <title>Users | ITD Bros</title>
@endsection

@section('css')
    <style>
        .modal-title{
            font-size: 16px;
        }
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
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-add-user mb-3" data-toggle="modal" data-target="#user-modal">Add User</button>
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
        
        <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title modal-user-title" id="smallmodalLabel">Add User</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="/itd/users/create" method="POST" enctype ='multipart/form-data'>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Account Type <span class="required">*</span></label>
                                <select class="form-control required-input" name="userrole" id="userrole" data-parsley-required="true">
                                    <option value="">Select Account Type</option>
                                    @foreach ($userRs['userrole'] as $userR)
                                        {
                                        <option value="{{ $userR->userRoleID }}">{{ $userR->roleType }}</option>
                                        }
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" class="form-control required-input" name="firstName">
                                    </div>
                                    <div class="col-md-6">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" class="form-control required-input" name="LastName">
                                    </div>
                                </div>                               
                            </div>
    
                        
                            {{--status should always be active--}}
                            {{--User Status ID--}}
                            {{--{{Form::label('Status', 'Status')}}--}}
                            {{--{{Form::text('Status', '', ['class' => 'form-control', 'placeholder'--}}
                            {{--=> 'Status'])}}--}}
                            {{--<select class="form-control" name="userstatus" id="userstatus" data-parsley-required="true">--}}
                                {{--@foreach ($userSs['userstatus'] as $userS)--}}
                                    {{--{--}}
                                    {{--<option value="{{ $userS->userStatusID }}">{{ $userS->userStatusType }}</option>--}}
                                    {{--}--}}
                                    {{--@endforeach--}}
                            {{--</select>--}}
                            <div class="form-group">
                                    <label>ID Number <span class="required">*</span></label>
                                    <input type="text" class="form-control numbers-only required-input" name="IDnumber" id="IDnumber">
                            </div>
                            <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="password" class="form-control required-input password" name="password" id="password">
                            </div>
                        
                            <div class="form-group">
                                    <label class="labelinput" for="contact">Phone Number<span class="required">*</span></label>
                                    <div class="input-group contact-number">
                                            <div class="input-group-prepend">
                                                    <select id="areacode" class="form-control required-input" name="areacode" required>
                                                        <option value="+63">63 (PH)</option>
                                                    </select>
                                            </div>
                                            <input type="text" class="form-control required-input mobile_number" name="phoneNumber" id="phoneNumber" maxlength=10>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" class="form-control required-input email" name="email" id="email">
                            </div>
                        
                            {{--departmentID--}}
                            <label>Department <span class="required">*</span></label>
                            <select class="form-control required-input" name="department" id="department" data-parsley-required="true">
                                <option value="" disabled selected>Select Department</option>
                                @foreach ($userDs['department'] as $userD)
                                    {
                                <option value="{{ $userD->departmentID }}">{{ $userD->departmentName }}</option>
                                    }
                                    @endforeach
                            </select>
                            {{--ID number--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-confirm">Confirm</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

    @endsection

    @section('scripts')
     <script type="text/javascript"> 
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
          

               $(document).on('click', '.btn-add-user', function(e){
                 e.preventDefault();
                 $('.btn-confirm').attr('id', 'btn-confirm-add-user');
        //  $('#user-modal').remove('fade in');
        //   $('#user-modal').addClass('show');
        //   $('#user-modal').modal('show');
            });
            $(document).on('click', '#btn-confirm-add-user', function(e){
                e.preventDefault();
                if(validate.standard('.required-input') ==  0){
                
                }
            });
      } );
  </script>

    @endsection