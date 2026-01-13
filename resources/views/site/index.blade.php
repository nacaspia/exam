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
<section class="banner-area bg_cover mt-80" style="background-image: url({{ asset('site/assets/images/banner-bg-1.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="banner-content">
                    <span>eDus Digital Institute</span>
                    <h1 class="title">The New Way To Learn.</h1>
                    <ul>
                        @if(user())
                            <li><a class="main-btn" href="{{ route('site.user.account',['locale'=>app()->getLocale()]) }}"><span>+</span> {{ __('site.account') }}</a></li>
                        @else
                            <li><a class="main-btn" href="{{ route('site.auth.login',['locale'=>app()->getLocale()]) }}"><span>+</span> {{ __('site.login') }}</a></li>
                        @endif
                        <li><a class="main-btn-2 main-btn" href="{{ route('site.contact',['locale'=>app()->getLocale()]) }}"><span>+</span>{{ __('site.contact_us') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-shape-1">
        <img src="{{ asset('site/assets/images/shapes/item-1.png') }}" alt="shape">
    </div>
    <div class="banner-shape-2">
        <img src="{{ asset('site/assets/images/shapes/item-2.png') }}" alt="shape">
    </div>
</section>
<div class="dream-course-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dream-course-content">
                    <div class="dream-course-title text-center">
                        <span>{{ __('site.search_exam') }}</span>
                    </div>
                    <form method="GET" action="{{ route('site.search',['locale'=>app()->getLocale()]) }}">
                        <div class="dream-course-search d-flex">
                            <div class="input-box">
                                <i class="fal fa-search"></i>
                                <input type="text" name="search" placeholder="{{ __('site.search') }}">
                            </div>
                            <div class="dream-course-category d-none d-lg-inline-block">
                                <select name="class_id">
                                    <option value="">{{ __('site.classes') }}</option>
                                    @if(!empty($classes))
                                        @foreach($classes as $class)
                                            <option value="{{$class['id']}}">{{$class['name'][language()]}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="dream-course-category  d-none d-lg-inline-block">
                                <select name="subject_id">
                                    <option value="">{{ __('site.subjects') }}</option>
                                    @if(!empty($subjects))
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject['id']}}">{{$subject['name'][language()]}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="dream-course-btn">
                                <button type="submit">{{ __('site.start_search') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="offer-area bg_cover pt-110 pb-120" style="background-image: url({{ asset('site/assets/images/offer-bg.jpg') }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="offer-content text-center">
                    <span>Are You Ready For This Offer</span>
                    <h2 class="title">50% Offer For Very First 50 Students & Mentors.</h2>
                    <ul>
                        <li>
                        @if(user())
                            <li><a class="main-btn" href="{{ route('site.user.account',['locale'=>app()->getLocale()]) }}"><i class="fal fa-user"></i>{{ __('site.account') }}</a></li>
                        @else
                            <li><a class="main-btn" href="{{ route('site.auth.login',['locale'=>app()->getLocale()]) }}"><i class="fal fa-lock"></i> {{ __('site.login') }}</a></li>
                        @endif
{{--                            <a class="main-btn" href="#"><i class="fal fa-user"></i> Become A Student</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="advance-courses-area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title">
                    <h3 class="title">Advance Courses <span>For Students.</span></h3>
                </div>
            </div>
        </div>
        <div class="row courses-active">
            @if(!empty($questions[0]))
                @foreach($questions as $question)

                    <div class="col-lg-4">
                        <div class="single-courses mt-30">
                            <div class="courses-thumb">
                                <img src="{{ asset('storage/'.$question['image']) }}" alt="{{$question['title'][app()->getLocale()]}}">
                               {{-- <div class="courses-review">
                                    <span><span><i class="fas fa-star"></i>5.6</span> (1200+)</span>
                                </div>--}}
                                <div class="corses-thumb-title">
                                    <span>{{ $question->class->name[language()] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="courses-content">
                                <a href="#">
                                    <h4 class="title">{{$question['title'][app()->getLocale()]}}</h4>
                                </a>

                                <div class="courses-info d-flex justify-content-between">
                                    <div class="item">
                                        <p>{{ $question->subject->name[language()] ?? '' }}</p>
                                        @if($question->is_paid)
                                            <span>{{ $question->price }} AZN</span>
                                        @else
                                            <span>Pulsuz</span>
                                        @endif
                                    </div>
                                    @if(user())
                                        @php
                                            $examResult = \App\Models\ExamResult::where('user_id', user()->id)
                                                ->where('exam_id', $question->id)
                                                ->first();
                                        @endphp

                                        @if($examResult && $examResult->status === 'finished')
                                            <a href="{{ route('site.user.exam.result', ['locale' => app()->getLocale(),'exam'=>$question->id]) }}">
                                                Nəticəyə bax
                                            </a>
                                        @else
                                            <a href="{{ route('site.user.exams.show',['locale' => app()->getLocale(),'exam'=> $question->id]) }}">
                                                İmtahana başla
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('site.auth.login',['locale' => app()->getLocale()]) }}">
                                            Daxil ol
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
{{--
<section class="counter-area bg_cove" style="background-image: url({{ asset('site/assets/images/counter-bg.jpg') }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center">
                    <h3 class="title">Some Fun Facts From Us.</h3>
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
<section class="testimonials-area pb-115 bg_cover" style="background-image: url({{ asset('site/assets/images/testimonials-pattern.png') }})">
    <div class="container">
        <div class="row testimonials-active">
            <div class="col-lg-12">
                <div class="testimonials-content text-center">
                    <i class="fas fa-quote-left"></i>
                    <h3 class="title">See the E Learning Tools your competitors are already using - <span>Start Now!</span></h3>
                    <p>Our service is free to users because vendors pay us when they receive web traffic. We list all vendors - not just those that pay us - in our comprehensive directory so that you can compare, sort and filter your results to make the most informed decision possible. GetApp is a Gartner company. Gartner (NYSE: IT) is the world's leading information technology research.</p>
                    <img src="{{ asset('site/assets/images/testimonials-thumb-1.png') }}" alt="testimonials">
                    <h5>Rosalina D. William</h5>
                    <span>Founder of Cinbelor</span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="testimonials-content text-center">
                    <i class="fas fa-quote-left"></i>
                    <h3 class="title">See the E Learning Tools your competitors are already using - <span>Start Now!</span></h3>
                    <p>Our service is free to users because vendors pay us when they receive web traffic. We list all vendors - not just those that pay us - in our comprehensive directory so that you can compare, sort and filter your results to make the most informed decision possible. GetApp is a Gartner company. Gartner (NYSE: IT) is the world's leading information technology research.</p>
                    <img src="{{ asset('site/assets/images/testimonials-thumb-2.png') }}" alt="testimonials">
                    <h5>Rosalina D. William</h5>
                    <span>Founder of Cinbelor</span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="testimonials-content text-center">
                    <i class="fas fa-quote-left"></i>
                    <h3 class="title">See the E Learning Tools your competitors are already using - <span>Start Now!</span></h3>
                    <p>Our service is free to users because vendors pay us when they receive web traffic. We list all vendors - not just those that pay us - in our comprehensive directory so that you can compare, sort and filter your results to make the most informed decision possible. GetApp is a Gartner company. Gartner (NYSE: IT) is the world's leading information technology research.</p>
                    <img src="{{ asset('site/assets/images/testimonials-thumb-3.png') }}" alt="testimonials">
                    <h5>Rosalina D. William</h5>
                    <span>Founder of Cinbelor</span>
                </div>
            </div>
        </div>
    </div>
</section>=
--}}

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
