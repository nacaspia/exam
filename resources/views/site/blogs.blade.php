@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.blogs') }}
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
    <section class="blog-standard-area gray-bg pt-80 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-standard">
                        <div class="single-blog-standard mt-40">
                            <div class="blog-thumb">
                                <img src="{{ asset('site/assets/images/blog-standard-1.jpg') }}" alt="standard">
                            </div>
                            <div class="blog-content bg-white">
                                <span>Businese</span>
                                <a href="#">
                                    <h3 class="title">Lorem ipsum dolor sit amet, consecte cing elit, sed do eiusmod tempor.</h3>
                                </a>
                                <ul>
                                    <li><i class="fal fa-eye"></i> 232 Views</li>
                                    <li><i class="fal fa-comments"></i> 35 Comments</li>
                                    <li><i class="fal fa-calendar-alt"></i>24th March 2019</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                <div class="user-blog-info d-block d-sm-flex justify-content-between align-items-center">
                                    <div class="info d-flex align-items-center">
                                        <img src="{{ asset('site/assets/images/blog-info-1.png') }}" alt="blog">
                                        <span>by <span>Hetmayar</span></span>
                                    </div>
                                    <div class="blog-details-more">
                                        <a href="#"><i class="fal fa-arrow-right"></i> Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-blog-standard mt-40">
                            <div class="blog-thumb">
                                <img src="{{ asset('site/assets/images/blog-standard-1.jpg') }}" alt="standard">
                            </div>
                            <div class="blog-content bg-white">
                                <span>Businese</span>
                                <a href="#">
                                    <h3 class="title">Lorem ipsum dolor sit amet, consecte cing elit, sed do eiusmod tempor.</h3>
                                </a>
                                <ul>
                                    <li><i class="fal fa-eye"></i> 232 Views</li>
                                    <li><i class="fal fa-comments"></i> 35 Comments</li>
                                    <li><i class="fal fa-calendar-alt"></i>24th March 2019</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                <div class="user-blog-info d-block d-sm-flex justify-content-between align-items-center">
                                    <div class="info d-flex align-items-center">
                                        <img src="{{ asset('site/assets/images/blog-info-1.png') }}" alt="blog">
                                        <span>by <span>Hetmayar</span></span>
                                    </div>
                                    <div class="blog-details-more">
                                        <a href="#"><i class="fal fa-arrow-right"></i> Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-blog-standard mt-40">
                            <div class="blog-thumb">
                                <img src="{{ asset('site/assets/images/blog-standard-1.jpg') }}" alt="standard">
                            </div>
                            <div class="blog-content bg-white">
                                <span>Businese</span>
                                <a href="#">
                                    <h3 class="title">Lorem ipsum dolor sit amet, consecte cing elit, sed do eiusmod tempor.</h3>
                                </a>
                                <ul>
                                    <li><i class="fal fa-eye"></i> 232 Views</li>
                                    <li><i class="fal fa-comments"></i> 35 Comments</li>
                                    <li><i class="fal fa-calendar-alt"></i>24th March 2019</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidi-dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                <div class="user-blog-info d-block d-sm-flex justify-content-between align-items-center">
                                    <div class="info d-flex align-items-center">
                                        <img src="{{ asset('site/assets/images/blog-info-1.png') }}" alt="blog">
                                        <span>by <span>Hetmayar</span></span>
                                    </div>
                                    <div class="blog-details-more">
                                        <a href="#"><i class="fal fa-arrow-right"></i> Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fal fa-angle-double-left"></i></span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">10</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="fal fa-angle-double-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="blog-sidebar ml-10">
                        <div class="blog-side-about white-bg mt-40">
                            <div class="about-title">
                                <h4 class="title">Never Miss News</h4>
                            </div>
                            <div class="blog-social-content mt-35 text-center">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-telegram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="banner-add mt-40">
                            <img src="{{ asset('site/assets/images/sidebar-add.jpg') }}" alt="">
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
