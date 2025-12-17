@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.login') }}
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset('site/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    <style>
        .contact-action-item a {
            font-size: 15px;
            text-decoration: underline;
        }

    </style>
@endsection
@section('site.content')
    <section class="contact-action-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-action-item">
                        <h6 class="title">{{ __('site.login') }}</h6>
                        <form id="contact-form" action="https://themeforest.kreativdev.com/edus/assets/contact.php" method="post">
                            <div class="input-box mt-20">
                                <input name="username" type="text" placeholder="Enter your name">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="input-box mt-20">
                                <input name="password" type="password" placeholder="****">
                                <i class="fal fa-lock"></i>
                            </div>
                            <div class="input-box mt-20">
                                <button type="submit">Submit Now</button>
                            </div>
                        </form>
                        <p class="form-message"></p>

                        <div class="mt-20 d-flex justify-content-between">
                            <a href="{{ route('site.auth.register') }}" class="text-primary">Qeydiyyat</a>
                            <a href="{{ route('site.auth.forgot-password') }}" class="text-primary">Şifrəni unutdum?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map">
            <img src="{{ asset('site/assets/images/contact-info-thumb-1.jpg') }}" width="600" height="450" style="border:0;" alt="info">
        </div>
    </section>
@endsection
@section('site.js')
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/ajax-contact.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
@endsection
