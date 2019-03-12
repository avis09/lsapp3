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
    <title>Login | BROS</title>
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
      {{-- <div class="logo">
        <h1>BROS</h1>
      </div> --}}
      <div class="login-box">
        <form class="login-form" method="POST" action="{{ route('login') }}">
          {{-- <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>BROS</h3> --}}
          <div class="text-center">
            <img class="site-logo" src="{{asset('images/icons/benilde.png')}}" alt="">
            <h5 class="login-head">Benilde Reservation Online Services</h5>
          </div>
          @csrf

          @if($errors->any())
        <div class="alert alert-danger text-center alert-message">
          {{$errors->first()}}
        </div>
          @endif
        <div class="form-group">
            <label class="control-label">ID Number</label>
            <input id="IDnumber" type="text" class="form-control login-input {{ $errors->has('IDnumber') ? ' is-invalid' : '' }}" name="IDnumber" value="{{ old('IDnumber') }}" autofocus>

                @if ($errors->has('IDnumber'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('IDnumber') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group">
                <label class="control-label">Password</label>
                <input id="password" type="password" class="form-control login-input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>
        {{-- <div class="form-group row">
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> --}}

          {{-- <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div> --}}
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>LOGIN</button>
          </div>
        </form>         
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


    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
      });

      $(document).on('submit', '.login-form',  function(){
        // e.preventDefault();
        $('.alert-message').hide();
        if(validate.standard('.login-input') == 0){
          $('.login-form').submit();
        }
        return false;
      });



    //   function loginUser() {
    //     var loginForm = $('#login-form');
    //     var formData = loginForm.serialize();
    //     $.ajax({
    //             url: '/login',
    //             type: 'POST',
    //             data: formData,
    //             dataType: 'json'
    //         })
    //         .done(function (data, status) {

    //             if(data.success === true) {
    //                 window.location.replace(data.responseText);
    //             }
    //             else {
    //                 $('#password').val('');
    //                 $('.error-text-login').removeClass('d-none').addClass('d-block').html(data.responseText);
    //                 $('#login-user').html('Login').removeClass('disabled');
    //             }
    //         })
    // }

    </script>
  </body>
</html>
