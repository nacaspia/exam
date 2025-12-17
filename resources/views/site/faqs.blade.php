@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.faqs') }}
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
    <section class="faq-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="faq-title">
                        <h3 class="title">Purchases & <span>Refunds</span></h3>
                        <p>Postgraduate research with us offers the opportunity to contribute to our leading edge research.</p>
                    </div>
                    <div class="faq-accordion mt-30">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a class="" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Why won't my payment go through?
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit. </p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                        </div>
                    </div> <!-- faq accordion -->
                </div>
                <div class="col-lg-6">
                    <div class="faq-title faq-title-2">
                        <h3 class="title">Making <span>Courses</span></h3>
                        <p>Postgraduate research with us offers the opportunity to contribute to our leading edge research.</p>
                    </div>
                    <div class="faq-accordion mt-30">
                        <div class="accordion" id="accordionExample-2">
                            <div class="card">
                                <div class="card-header" id="heading6">
                                    <a class="" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                        Why won't my payment go through?
                                    </a>
                                </div>

                                <div id="collapse6" class="collapse show" aria-labelledby="heading6" data-parent="#accordionExample-2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="heading2">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample-2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit. </p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="heading3">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample-2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="heading4">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample-2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="heading5">
                                    <a class="collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        Why won't my payment go through?
                                    </a>
                                </div>
                                <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample-2">
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus odio fugit vero, voluptatum alias tenetur. Laboriosam, excepturi quod adipisci repudiandae cupiditate veritatis harum, iure deserunt blanditiis laborum officia sapiente, sit.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                        </div>
                    </div> <!-- faq accordion -->
                </div>
            </div>
        </div>
    </section>
    <section class="faq-answer-area bg_cover" style="background-image: url({{ asset('site/assets/images/faq-answer-bg.jpg') }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title section-title-2 text-center">
                        <h3 class="title">Didn't Find Answer?</h3>
                        <p>Postgraduate research with us offers the opportunity to contribute to our leading edge research.</p>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-box mt-30">
                            <input type="text" placeholder="Type your name">
                            <i class="fal fa-user"></i>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-box mt-30">
                            <input type="text" placeholder="Type your name">
                            <i class="fal fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-box text-center mt-30">
                            <textarea name="#" id="#" cols="30" rows="10" placeholder="Type your questions"></textarea>
                            <i class="fal fa-edit"></i>
                            <button type="button"><i class="fal fa-paper-plane"></i>Submit Now</button>
                        </div>
                    </div>
                </div>
            </form>
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
