@extends('layouts.dashboard-master')

@section('title')
    <title>Registrar Venues | ITD Bros</title>
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
            <h1><i class="fa fa-dashboard"></i> Change Password</h1>
            {{-- <p></p> --}}
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Change Password</a></li>
          </ul>
        </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-4">
                                    <form>
                                        <div class="form-group">
                                                <label class="control-label">Current Password <span class="required">*</span></label>
                                                <input type="password" name="current_password" class="form-control required-input">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password <span class="required">*</span></label>
                                                <input type="password" name="new_password" class="form-control required-input">
                                            </div>
                                            <div class="form-group">
                                                    <label class="control-label">Confirm New Password <span class="required">*</span></label>
                                                    <input type="password" name="confirm_new_password" class="form-control required-input">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-change-password btn-md">Save Password</button>
                                            </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
            </main>

    @endsection

    @section('scripts')
     <script type="text/javascript"> 

        $(document).ready(function() {
          
        });
  </script>

    @endsection


