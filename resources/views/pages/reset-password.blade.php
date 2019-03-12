<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/icons/benilde.ico') }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/particles.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('dashboard/css/custom.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Reset Password | BROS</title>
    <style>
      .site-logo{
        height: 70px;
        width:auto;
      }
      .bg-primary{
        background-color: #025f33!important;
      }
      .login-head{
        margin-bottom: 10px;
        padding: 8px;
      }

      .login-content .login-box {
        min-width: 430px;
        padding: 40px 30px;
      }
      body{
            font: normal 90% Arial, Helvetica, sans-serif;
      }
    </style>
  </head>
  <body>
    {{-- <section class="material-half-bg"> --}}

       <div id="particles-js"></div> 
       {{-- <div class="count-particles"> <span class="js-count-particles"></span> particles  --}}
      </div>

      <section class="bg-primary">
      <div class="cover"></div>
    </section>
    <section class="login-content bg-primary">
      <div class="login-box">
          <div class="container">
        <form id="form-reset-password">
          {{-- <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>BROS</h3> --}}
          <div class="text-center">
            <img class="site-logo" src="{{asset('images/icons/benilde.png')}}" alt="">
            <h5 class="login-head">Reset Password</h5>
            {{-- <h5 class="mb-3">Password Reset</h5> --}}
          </div>
          @csrf
          <div class="user-info">
            <div class="form-group">
                <h6 class="control-label">Name: {{$user->firstName." ".$user->lastName}}</h6>
                <h6 class="control-label">ID Number: {{$user->IDnumber}}</h6>
            </div>
          </div>
          <div class="password-container">
            <div class="form-group">
                <label class="control-label">New Password <span class="required">*</span></label>
                <input id="new-password" type="password" class="form-control password" name="new_password" autofocus>
            </div>

            <div class="form-group">
                    <label class="control-label">Confirm New Password <span class="required">*</span></label>
                    <input id="confirm-password" type="password" class="form-control password" name="confirm_password">
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block btn-reset-password"><i class="fa fa-lock fa-lg fa-fw"></i>Reset Password</button>
          </div>
        </form>     
    </div>    
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{asset('dashboard/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('dashboard/js/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/js/main.js')}}"></script>
    <script src="{{asset('dashboard/js/custom.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('dashboard/js/plugins/pace.min.js')}}"></script>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 
    {{-- <script src="http://threejs.org/examples/js/libs/stats.min.js"></script> --}}
    <script src="{{asset('js/particles.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });

      $(document).on('submit', '#form-reset-password',  function(e){
        e.preventDefault();
        if(validate.standard('.password') == 0){
          $('.btn-reset-password').addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                url: "/itd/reset-password",
                type: 'POST',
                data: $('#form-reset-password').serialize()+'&id='+"{{$slug}}",
                success:function(data){
                         Swal.fire(
                              data.title,
                              data.message,
                              data.type
                        );
                       if(data.success === true){
                          var html = "<div class='alert alert-success text-center mt-5'><h5>Password successfully updated.</h5></div>";
                          // var button = '<div class="text-center"><button type="button" class="btn btn-secondary btn-close">Exit Page</button></div>';
                          $('.password-container').html(html);
                          $('.btn-container').html('');
                       }
                       else{
                          $('.password').removeClass('err_inputs');
                          $('.validate_error_message').remove();
                          $('.btn-reset-password').removeClass('disabled').html('<i class="fa fa-lock fa-lg fa-fw"></i>Reset Password');
                       }
                      
                }
            });
        }
        return false;
      });
      
    


    </script>
  </body>
</html>

