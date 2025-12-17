@extends('site.user.layouts.app')
@section('site.user.css')
@endsection
@section('site.user.content')
    <div class="main-content-wrapper">
        <div class="container-fluid">

            <!-- Student Top Start -->
            <div class="admin-top-bar students-top">
                <div class="courses-select">
                    <select>
                        <option data-display="All Courses">All Courses</option>
                        <option value="1">option</option>
                        <option value="2">option</option>
                        <option value="3">option</option>
                        <option value="4">Potato</option>
                    </select>

                    <h4 class="title">Meet people taking your courses</h4>
                </div>

                <a href="#" class="btn">Create New Course <i class="icofont-rounded-right"></i></a>
            </div>
            <!-- Student Top End -->

            <!-- Student's Wrapper Start -->
            <div class="students-wrapper students-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- Single Student Start -->
                            <div class="single-student">
                                <div class="student-images">
                                    <img src="{{ asset('site/user/assets/images/author/author-01.jpg') }}" alt="Author">
                                </div>
                                <div class="student-content">
                                    <h5 class="name">Margarita James</h5>
                                    <span class="country"><img src="{{ asset('site/user/assets/images/flag/flag-1.png') }}" alt="Flog"> Brazil</span>
                                    <p>Data Science and Machine learning</p>
                                    <span class="date"><i class="icofont-ui-calendar"></i> 28.03.2021</span>
                                </div>
                            </div>
                            <!-- Single Student End -->
                        </div>
                        <div class="swiper-slide">
                            <!-- Single Student Start -->
                            <div class="single-student">
                                <div class="student-images">
                                    <img src="{{ asset('site/user/assets/images/author/author-02.jpg') }}" alt="Author">
                                </div>
                                <div class="student-content">
                                    <h5 class="name">Stanley Castro</h5>
                                    <span class="country"><img src="{{ asset('site/user/assets/images/flag/flag-1.png') }}" alt="Flog"> Brazil</span>
                                    <p>Data Science and Machine learning</p>
                                    <span class="date"><i class="icofont-ui-calendar"></i> 28.03.2021</span>
                                </div>
                            </div>
                            <!-- Single Student End -->
                        </div>
                        <div class="swiper-slide">
                            <!-- Single Student Start -->
                            <div class="single-student">
                                <div class="student-images">
                                    <img src="{{ asset('site/user/assets/images/author/author-07.jpg') }}" alt="Author">
                                </div>
                                <div class="student-content">
                                    <h5 class="name">Beatrice Summers</h5>
                                    <span class="country"><img src="{{ asset('site/user/assets/images/flag/flag-1.png') }}" alt="Flog"> Brazil</span>
                                    <p>Data Science and Machine learning</p>
                                    <span class="date"><i class="icofont-ui-calendar"></i> 28.03.2021</span>
                                </div>
                            </div>
                            <!-- Single Student End -->
                        </div>
                        <div class="swiper-slide">
                            <!-- Single Student Start -->
                            <div class="single-student">
                                <div class="student-images">
                                    <img src="{{ asset('site/user/assets/images/author/author-08.jpg') }}" alt="Author">
                                </div>
                                <div class="student-content">
                                    <h5 class="name">Beatrice Summers</h5>
                                    <span class="country"><img src="{{ asset('site/user/assets/images/flag/flag-1.png') }}" alt="Flog"> Brazil</span>
                                    <p>Data Science and Machine learning</p>
                                    <span class="date"><i class="icofont-ui-calendar"></i> 28.03.2021</span>
                                </div>
                            </div>
                            <!-- Single Student End -->
                        </div>
                        <div class="swiper-slide">
                            <!-- Single Student Start -->
                            <div class="single-student">
                                <div class="student-images">
                                    <img src="{{ asset('site/user/assets/images/author/author-09.jpg') }}" alt="Author">
                                </div>
                                <div class="student-content">
                                    <h5 class="name">Beatrice Summers</h5>
                                    <span class="country"><img src="{{ asset('site/user/assets/images/flag/flag-1.png') }}" alt="Flog"> Brazil</span>
                                    <p>Data Science and Machine learning</p>
                                    <span class="date"><i class="icofont-ui-calendar"></i> 28.03.2021</span>
                                </div>
                            </div>
                            <!-- Single Student End -->
                        </div>
                    </div>

                    <div class="students-arrow">
                        <!-- Add Pagination -->
                        <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div>
                        <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- Student's Wrapper End -->

            <!-- Student's Map Start -->
            <div class="students-map">
                <h4 class="title">Student's locations and languages.</h4>

                <div class="map">
                    <div id="vmap"></div>
                </div>
            </div>
            <!-- Student's Map End -->


            <!-- New Courses Start -->
            <div class="new-courses" style="background-image: url({{ asset('site/user/assets/images/new-courses-banner.jpg') }});">
                <div class="new-courses-title">
                    <h3 class="title">Your students want to learn more. <br> Consider creating new courses to meet that deman.</h3>
                </div>
                <img class="shape d-none d-xl-block" src="{{ asset('site/user/assets/images/shape/shape-27.png') }}" alt="Shape">
                <div class="new-courses-btn">
                    <a href="#" class="btn">Create New Course <i class="icofont-rounded-right"></i></a>
                </div>
            </div>
            <!-- New Courses End -->

        </div>
    </div>
@endsection
@section('site.user.js')
@endsection
