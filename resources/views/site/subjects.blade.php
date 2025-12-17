@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.main') }}
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
    <section class="course-grid-area pt-90 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="course-grid mt-30">
                        <div class="course-grid-top d-sm-flex d-block justify-content-between align-items-center">
                            <div class="course-filter d-block align-items-center d-sm-flex">
                                <select>
                                    <option data-display="{{ __('site.classes') }}">{{ __('site.classes') }}</option>
                                    <option value="1">Filter 2</option>
                                    <option value="2">Filter 3</option>
                                    <option value="3">Filter 4</option>
                                    <option value="4">Filter 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-10 justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="single-courses mt-30">
                                <div class="courses-thumb">
                                    <img src="{{ asset('site/assets/images/courses-grid-1.jpg') }}" alt="courses">
                                    <div class="courses-review">
                                        <span><i class="fas fa-star"></i>5.6</span>
                                    </div>
                                    <div class="corses-thumb-title">
                                        <span>Games, Art</span>
                                    </div>
                                </div>
                                <div class="courses-content">
                                    <a href="#">
                                        <h4 class="title">Discover industry leading E Learning Tools</h4>
                                    </a>
                                    <div class="courses-info d-flex justify-content-between">
                                        <div class="item">
                                            <p>By Rosalina D.</p>
                                        </div>
                                        <span>$46</span>
                                    </div>
                                    <ul>
                                        <li><i class="fal fa-users"></i> 23</li>
                                        <li><i class="fal fa-clock"></i> 10 Hr</li>
                                        <li><i class="fal fa-comments"></i> 143</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="single-courses mt-30">
                                <div class="courses-thumb">
                                    <img src="{{ asset('site/assets/images/courses-grid-1.jpg') }}" alt="courses">
                                    <div class="courses-review">
                                        <span><i class="fas fa-star"></i>5.6</span>
                                    </div>
                                    <div class="corses-thumb-title">
                                        <span>Games, Art</span>
                                    </div>
                                </div>
                                <div class="courses-content">
                                    <a href="#">
                                        <h4 class="title">Discover industry leading E Learning Tools</h4>
                                    </a>
                                    <div class="courses-info d-flex justify-content-between">
                                        <div class="item">
                                            <p>By Rosalina D.</p>
                                        </div>
                                        <span>$46</span>
                                    </div>
                                    <ul>
                                        <li><i class="fal fa-users"></i> 23</li>
                                        <li><i class="fal fa-clock"></i> 10 Hr</li>
                                        <li><i class="fal fa-comments"></i> 143</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="single-courses mt-30">
                                <div class="courses-thumb">
                                    <img src="{{ asset('site/assets/images/courses-grid-1.jpg') }}" alt="courses">
                                    <div class="courses-review">
                                        <span><i class="fas fa-star"></i>5.6</span>
                                    </div>
                                    <div class="corses-thumb-title">
                                        <span>Games, Art</span>
                                    </div>
                                </div>
                                <div class="courses-content">
                                    <a href="#">
                                        <h4 class="title">Discover industry leading E Learning Tools</h4>
                                    </a>
                                    <div class="courses-info d-flex justify-content-between">
                                        <div class="item">
                                            <p>By Rosalina D.</p>
                                        </div>
                                        <span>$46</span>
                                    </div>
                                    <ul>
                                        <li><i class="fal fa-users"></i> 23</li>
                                        <li><i class="fal fa-clock"></i> 10 Hr</li>
                                        <li><i class="fal fa-comments"></i> 143</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="pagination-item d-flex justify-content-center mt-50">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true"><i class="fal fa-arrow-left"></i></span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">10</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true"><i class="fal fa-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
