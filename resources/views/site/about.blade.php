@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.about_us') }}
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
@endsection
@section('site.content')
    <section class="access-area pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="access-thumb">
                        <img src="{{ asset('site/assets/images/access-thumb.jpg') }}" alt="access">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="access-content">
                        <div class="access-title">
                            <span></span>
                            <h3 class="title">Unlimited Access To Over <span>1500 Classes.</span></h3>
                        </div>
                        <div class="access-mission">
                            <h4 class="title">eDus <span>Mission</span></h4>
                            <p>See the E Learning Tools your competitors are already using - Start Now! GetApp helps more than 800k businesses find the best software for their needs to know about our mission. </p>
                        </div>
                        <div class="access-vision">
                            <h4 class="title">eDus <span>vision</span></h4>
                            <p>See the E Learning Tools your competitors are already using - Start Now! GetApp helps more than 800k businesses find the best software for their needs to know about our mission. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-counter-area bg_cover pt-120 pb-120" style="background-image: url({{ asset('site/assets/images/counter-bg-2.png') }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-counter-content">
                        <h3 class="title">Make Some Noise With Us.</h3>
                        <span>See the E Learning Tools your competitors are already using - Start Now!</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                    </div>
                    <div class="about-counter-item d-block d-sm-flex justify-content-center justify-content-sm-between">
                        <div class="counter-item text-center text-sm-left">
                            <h4 class="title"><span class="counter">150</span>+</h4>
                            <span>Cool Mentors</span>
                        </div>
                        <div class="counter-item text-center text-sm-left">
                            <h4 class="title"><span class="counter">100</span>+</h4>
                            <span>Subjects</span>
                        </div>
                        <div class="counter-item text-center text-sm-left">
                            <h4 class="title"><span class="counter">1</span>M+</h4>
                            <span>Students</span>
                        </div>
                        <div class="counter-item text-center text-sm-left">
                            <h4 class="title"><span class="counter">10</span>+</h4>
                            <span>Country</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="counter-thumb ml-30">
                        <img src="{{ asset('site/assets/images/counter-thumb.jpg') }}" alt="counter">
                        <a class="video-popup" href="https://www.youtube.com/watch?v=TdSA7gkVYU0"><i class="fal fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sponsors-area bg_cover pb-120" style="background-image: url({{ asset('site/assets/images/sponsors-bg.jpg') }})">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h3 class="title">Our Sponsors</h3>
                    </div>
                </div>
            </div>
            <div class="row brand-active owl-carousel">
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-brand">
                        <img src="{{ asset('site/assets/images/brand-1.png') }}" alt="brand">
                    </div>
                </div>
            </div>
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
