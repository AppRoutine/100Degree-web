<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap Core CSS -->
    <link href="http://206.189.126.187/yair/public/theme/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style Core CSS -->
    <link href="http://206.189.126.187/yair/public/theme/assets/css/style.css" rel="stylesheet">
    <!-- Animate Core CSS -->
    <link href="http://206.189.126.187/yair/public/theme/assets/css/animate.css" rel="stylesheet">
    <!-- Hover Core CSS -->
    <link href="http://206.189.126.187/yair/public/theme/assets/css/hover.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="http://206.189.126.187/yair/public/theme/assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="http://206.189.126.187/yair/public/theme/assets/css/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
<style>
.error
{
    color:red!important;
    margin-top: 10px;
}
.help-block{
color:red !important;
}
</style>
@yield('css')
</head>
<body class="login-form-outer cyan">
    <!-- Login section start here-->
    <div class="login-form-wrap static-copyright">

<div class="form-login zoomIn animated">
            <div class="form-login-inner">
                <!-- Logo section start here-->
                <div class="logo-wrap" style="border-radius: 0px;width:70%;">
                    <a href="javascript:void(0)">
                        <img src="" alt="Carry First" />
                    </a>
                </div>
                <!-- Logo section close here-->
                <h1>Registration Successful!</h1>
                <div class="alert alert-success fade in">
                    <p class="description">Now, Your Email id verified successful.
                    </p>
                </div>
            </div>
        </div>
<!-- Login section end here-->
    <script src="http://206.189.126.187/yair/public/theme/assets/js/jquery-3.2.1.min.js"></script>
    <script src="http://206.189.126.187/yair/public/theme/assets/js/bootstrap.js"></script>
    <script src="http://206.189.126.187/yair/public/theme/assets/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="http://206.189.126.187/yair/public/theme/assets/js/additional-methods.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://206.189.126.187/yair/public/theme/assets/js/jquery.toast.min.js"></script>

@if (session('error'))
    <script type="text/javascript">
        $.toast({
            heading: 'Error',
            text: '{{ session('error') }}',
            position: 'top-right',
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
    @yield('js')
</body>
</html>
