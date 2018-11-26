<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <title>Admin Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{!! asset('css/custom.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery.toast.min.css') !!}">

    <link rel="icon" href="{{ URL::to('/') }}/assets/app-icon.png" type="img/x-icon">
    <style>
      .error_msg{ color: red; }
    </style><style>
      .error_msg{ color: red; }
    </style>
</head>
<body class="main-wrapper">
    <div class="login-wrapper">
        <div class="login-wrapper-inner">
            <h1><img src="{{ URL::to('/') }}/assets/app-icon.png" alt="Logo" style="width:130px;"></h1>
        </div>

         @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
        <form class="form" id="frmLogin" action="{{route('login')}}" method="post">
            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
            <div class="contact-form-group">
               <input type="email" class="contact-form-control" id="email" name="email" placeholder="Email Address">
            </div>

            <div class="contact-form-group">
               <input type="password" class="contact-form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="errorMsg">
                <div id="error_msg1" class="error_msg"></div>
            </div>

            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    <i class="aria-hidden"></i>Remember Me
                </label>
             </div> -->
             <input type="hidden" name="login_player_field" id="login_player_field" value="">
            <div class="text-center">
                <button type="submit" id="submit-login" class="submit-login">Login</button>
            </div>
        </form>
        <!-- <a href="{{ URL::to('/') }}/forgot-password" class="forgot">Forgot password?</a> -->
    </div>
</body>
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.toast.min.js') !!}"></script>



@if (session('success'))
    <script type="text/javascript">
        $.toast({
            heading: 'Success',
            text: '{{ session('success') }}',
            showHideTransition: 'slide',
            position: 'bottom-right',
            stack: 2,
            icon: 'success'
        });
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

@if (session('error'))
    <script type="text/javascript">
        $.toast({
            heading: 'Error',
            text: '{{ session('error') }}',
            position: 'bottom-right',
            stack: 2,
            icon: 'error',
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600'  // To change the background
        })
    </script>
    @php
        session()->forget('error');
    @endphp
@endif
<script type="text/javascript">
    $('form').submit(function () {
        document.getElementById('error_msg1').innerHTML = "";
        // Get the Login Name value and trim it
        var email = $.trim($('#email').val());
        // Check if empty of not
        if (email  === '') {
            document.getElementById('error_msg1').innerHTML = 'Email field is empty.';
            return false;
        }
        // Get the Login Name value and trim it
        var password = $.trim($('#password').val());
        // Check if empty of not
        if (password  === '') {
            document.getElementById('error_msg1').innerHTML = 'Password field is empty.';
            return false;
        }
    });
</script>
</html>
