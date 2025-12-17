@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.contact_us') }}
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
    <section class="contact-info-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="section-title section-title-2">
                        <h3 class="title">Contact  <span>Info</span></h3>
                        <p>Postgraduate research with us offers the opportunity to contribute to our leading edge research.</p>
                    </div>
                    <div class="contact-info-content">
                        <div class="single-contact-info d-flex align-items-center">
                            <div class="info-icon">
                                <i class="fal fa-phone"></i>
                            </div>
                            <div class="info-contact">
                                <h4 class="title">Phone Number</h4>
                                <span>+7 (800) 123 45 69</span>
                            </div>
                        </div>
                        <div class="single-contact-info item-2 d-flex align-items-center">
                            <div class="info-icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="info-contact">
                                <h4 class="title">Email Address</h4>
                                <span>info@epicexample.com</span>
                            </div>
                        </div>
                        <div class="single-contact-info item-3 d-flex align-items-center">
                            <div class="info-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="info-contact">
                                <h4 class="title">Office Address</h4>
                                <span>PO Box 97845 Baker st. 567, Los Angeles, <br> California, US.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact-info-thumb ml-85">
                        <img src="{{ asset('site/assets/images/contact-info-thumb-1.jpg') }}" alt="info">
                        <img class="item-2" src="{{ asset('site/assets/images/contact-info-thumb-2.jpg') }}" alt="info">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="counter-area counter-area-2 counter-contact bg_cove" style="background-image: url({{ asset('site/assets/images/counter-bg.jpg') }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title section-title-2 text-center">
                        <h3 class="title">Some Fun Facts</h3>
                        <p>Postgraduate research with us offers the opportunity to contribute to our leading edge research.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-item text-center pt-40">
                        <h3 class="title"><span class="counter">150</span>+</h3>
                        <span>Cool Mentors</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-item text-center pt-40 item-2">
                        <h3 class="title"><span class="counter">1490</span>+</h3>
                        <span>Students</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-item text-center pt-40 item-3">
                        <h3 class="title"><span class="counter">100</span>+</h3>
                        <span>Courses</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-item text-center pt-40 item-4">
                        <h3 class="title"><span class="counter">10</span>+</h3>
                        <span>Years Experience</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter-dot">
            <img src="{{ asset('site/assets/images/counter-dot.png') }}" alt="dot">
        </div>
    </section>
    <section class="contact-action-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-action-item">
                        <h2 class="title">Call To Action</h2>
                        <form id="contact-form" action="https://themeforest.kreativdev.com/edus/assets/contact.php" method="post">
                            <div class="input-box mt-20">
                                <input name="name" type="text" placeholder="Enter your name">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="input-box mt-20">
                                <input name="email" type="email" placeholder="Enter your email">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="input-box mt-20">
                                <textarea name="message" id="#" cols="30" rows="10" placeholder="Enter your message"></textarea>
                                <i class="fal fa-edit"></i>
                                <button type="submit">Submit Now</button>
                            </div>
                        </form>
                        <p class="form-message"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7306.852145413201!2d90.45390659294884!3d23.69646870098038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1573417792650!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen=""></iframe>
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
