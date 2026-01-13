<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NACASPIA CMS</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
    <link rel="stylesheet" id="rtlStyle" href="#">
</head>
<body class="light-theme">
<!-- preloader start -->
<div class="preloader d-none">
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- preloader end -->

<!-- main content start -->
<div class="main-content login-panel login-panel-3">
    <div class="container">
        <div class="d-flex justify-content-end">
            <div class="login-body">
                <div class="top d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <img src="{{ asset('assets/images/logo-black.png') }}" alt="Logo">
                    </div>
                    <a href=""><i class="fa-duotone fa-house-chimney"></i></a>
                </div>
                <div class="bottom">
                    <h3 class="panel-title">@lang('content.login')</h3>
                  @include('errors.messages')
                    <form action="{{ route('auth') }}" method="POST">
                        @csrf
                        <div class="input-group mb-25">
                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="@lang('content.username')">
                        </div>
                        <div class="input-group mb-20">
                            <span class="input-group-text"><i class="fa-regular fa-lock"></i></span>
                            <input type="password" name="password" class="form-control rounded-end" placeholder="@lang('content.password')">
                            <a role="button" class="password-show"><i class="fa-duotone fa-eye"></i></a>
                        </div>
                        <button class="btn btn-primary w-100 login-btn">@lang('content.login_send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main content end -->
<script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- for demo purpose -->
<script>
    var rtlReady = $('html').attr('dir', 'ltr');
    if (rtlReady !== undefined) {
        localStorage.setItem('layoutDirection', 'ltr');
    }
</script>
</body>
</html>
