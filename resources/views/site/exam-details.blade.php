@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.exams') }}
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
    <section class="course-details-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="course-details-items white-bg">
                        <div class="course-thumb">
                            <img src="{{ $question->image? asset('storage/'.$question->image) : asset('site/assets/images/courses-grid-1.jpg') }}" alt="course">
{{--                            <div class="tab-btns">--}}
{{--                                <ul class="nav nav-pills d-flex justify-content-between" id="pills-tab" role="tablist">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true"><i class="fal fa-list"></i> Overview</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><i class="fal fa-book"></i> Curriculum</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><i class="fal fa-user"></i> Instructor</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false"><i class="fal fa-stars"></i> Reviews</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                                <div class="course-details-item">
                                    <div class="course-text">
                                        <p>This is the most comprehensive, yet straight-forward, course for the Python programming language on Udemy! Whether you have never programmed before, already know basic syntax, or want to learn about the advanced features of Python, this course is for you! In this course we will teach you Python 3. (Note, we also provide older Python 2 notes in case you need them)</p>
                                    </div>
                                    <div class="course-learn-list">
                                        <h4 class="title">What you'll learn </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-learn-text">
                                        <h4 class="title">What you'll learn </h4>
                                        <span>Become a Python Programmer and learn one of employer's most requested skills of 2019!</span>
                                        <p>With over 100 lectures and more than 20 hours of video this comprehensive course leaves no stone unturned! This course includes quizzes, tests, and homework assignments as well as 3 major projects to create a Python project portfolio!</p>
                                        <p class="pt-15 pb-15">This course will teach you Python in a practical manner, with every lecture comes a full coding screencast and a corresponding code notebook! Learn in whatever manner is best for you!</p>
                                        <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                    </div>
                                    <div class="course-learner-slide">
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          {{--  <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                <div class="course-details-item">
                                    <div class="course-text">
                                        <p>This is the most comprehensive, yet straight-forward, course for the Python programming language on Udemy! Whether you have never programmed before, already know basic syntax, or want to learn about the advanced features of Python, this course is for you! In this course we will teach you Python 3. (Note, we also provide older Python 2 notes in case you need them)</p>
                                    </div>
                                    <div class="course-learn-list">
                                        <h4 class="title">What you'll learn </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-learn-text">
                                        <h4 class="title">What you'll learn </h4>
                                        <span>Become a Python Programmer and learn one of employer's most requested skills of 2019!</span>
                                        <p>With over 100 lectures and more than 20 hours of video this comprehensive course leaves no stone unturned! This course includes quizzes, tests, and homework assignments as well as 3 major projects to create a Python project portfolio!</p>
                                        <p class="pt-15 pb-15">This course will teach you Python in a practical manner, with every lecture comes a full coding screencast and a corresponding code notebook! Learn in whatever manner is best for you!</p>
                                        <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                    </div>
                                    <div class="course-learner-slide">
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                                <div class="course-details-item">
                                    <div class="course-text">
                                        <p>This is the most comprehensive, yet straight-forward, course for the Python programming language on Udemy! Whether you have never programmed before, already know basic syntax, or want to learn about the advanced features of Python, this course is for you! In this course we will teach you Python 3. (Note, we also provide older Python 2 notes in case you need them)</p>
                                    </div>
                                    <div class="course-learn-list">
                                        <h4 class="title">What you'll learn </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-learn-text">
                                        <h4 class="title">What you'll learn </h4>
                                        <span>Become a Python Programmer and learn one of employer's most requested skills of 2019!</span>
                                        <p>With over 100 lectures and more than 20 hours of video this comprehensive course leaves no stone unturned! This course includes quizzes, tests, and homework assignments as well as 3 major projects to create a Python project portfolio!</p>
                                        <p class="pt-15 pb-15">This course will teach you Python in a practical manner, with every lecture comes a full coding screencast and a corresponding code notebook! Learn in whatever manner is best for you!</p>
                                        <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                    </div>
                                    <div class="course-learner-slide">
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                                <div class="course-details-item">
                                    <div class="course-text">
                                        <p>This is the most comprehensive, yet straight-forward, course for the Python programming language on Udemy! Whether you have never programmed before, already know basic syntax, or want to learn about the advanced features of Python, this course is for you! In this course we will teach you Python 3. (Note, we also provide older Python 2 notes in case you need them)</p>
                                    </div>
                                    <div class="course-learn-list">
                                        <h4 class="title">What you'll learn </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                                <div class="course-learn-item">
                                                    <i class="fal fa-check"></i>
                                                    <p>Learn to use Python professionally, learning both Python 2 and Python 3!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-learn-text">
                                        <h4 class="title">What you'll learn </h4>
                                        <span>Become a Python Programmer and learn one of employer's most requested skills of 2019!</span>
                                        <p>With over 100 lectures and more than 20 hours of video this comprehensive course leaves no stone unturned! This course includes quizzes, tests, and homework assignments as well as 3 major projects to create a Python project portfolio!</p>
                                        <p class="pt-15 pb-15">This course will teach you Python in a practical manner, with every lecture comes a full coding screencast and a corresponding code notebook! Learn in whatever manner is best for you!</p>
                                        <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                    </div>
                                    <div class="course-learner-slide">
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                        <div class="course-learner-item d-flex align-items-center">
                                            <div class="course-learner-thumb">
                                                <img src="assets/images/learner-thumb-1.jpg" alt="learner">
                                            </div>
                                            <div class="course-learner-content">
                                                <h5 class="title">Rosalina D. Williamson</h5>
                                                <span>Python Learner</span>
                                                <p>We will start by helping you get Python installed on your computer, regardless of your operating system, whether its Linux, MacOS, or Windows, we've got you covered!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="course-details-sidebar white-bg">
                        <div class="course-sidebar-thumb">
                            <img src="assets/images/course-sidebar-video-thumb.jpg" alt="course video">
                            <a class="video-popup" href="https://www.youtube.com/watch?v=TdSA7gkVYU0"><i class="fas fa-play"></i></a>
                        </div>
                        <div class="course-sidebar-price d-flex justify-content-between align-items-center">
                            <h3 class="title">$12.99 <span>$194.99</span></h3>
                            <span>93% Off</span>
                        </div>
                        <div class="course-sidebar-btns">
                            <p><i class="fal fa-clock"></i> 2 days left at this price!</p>
                            <a href="#"><i class="fal fa-shopping-cart"></i> Enroll Right Now</a>
                            <a class="btns" href="#"><i class="fal fa-ticket"></i> Have A Coupon</a>
                            <h6 class="title">This course includes</h6>
                            <ul>
                                <li><i class="fal fa-clock"></i> 24 hours on-demand video</li>
                                <li><i class="fal fa-edit"></i> 19 articles</li>
                                <li><i class="fal fa-code"></i> 19 coding exercises</li>
                                <li><i class="fal fa-globe"></i> Full lifetime access</li>
                                <li><i class="fal fa-tv"></i> Access on mobile and TV</li>
                                <li><i class="fal fa-certificate"></i> Certificate of Completion</li>
                            </ul>
                        </div>
                        <div class="course-sidebar-share">
                            <a href="#"><i class="fal fa-share"></i> Share Now</a>
                        </div>
                    </div>
                    <div class="trending-course">
                        <h4 class="title"><i class="fal fa-book"></i> Trending Course</h4>
                        <div class="single-courses mt-30">
                            <div class="courses-thumb">
                                <img src="assets/images/course-thumb.jpg" alt="course">
                                <div class="courses-review">
                                    <span><span><i class="fas fa-star"></i>5.6</span> (1200+)</span>
                                </div>
                                <div class="corses-thumb-title item-2">
                                    <span>Science</span>
                                </div>
                            </div>
                            <div class="courses-content">
                                <a href="#">
                                    <h4 class="title">Discover industry leading E Learning Tools</h4>
                                </a>
                                <div class="courses-info d-flex justify-content-between">
                                    <div class="item">
                                        <img src="assets/images/courses-info-thumb.png" alt="courses info">
                                        <p>Rosalina D. William</p>
                                    </div>
                                    <span>$46</span>
                                </div>
                                <ul>
                                    <li><i class="fal fa-users"></i> 23 Students</li>
                                    <li><i class="fal fa-clock"></i> 10 Hours</li>
                                    <li><i class="fal fa-comments"></i> 143</li>
                                </ul>
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
