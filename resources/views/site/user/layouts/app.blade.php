<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edule - eLearning Website Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('site/user/assets/images/favicon.ico') }}">
    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('site/user/assets/css/vendor/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/user/assets/css/style.min.css') }}">
    @yield('site.user.css')
</head>
<body>
<div class="main-wrapper main-wrapper-02">

    <!-- Login Header Start -->
    <div class="section login-header">
        <!-- Login Header Wrapper Start -->
        <div class="login-header-wrapper navbar navbar-expand">

            <!-- Header Logo Start -->
            <div class="login-header-logo">
                <a href="{{ route('site.index') }}"><img src="{{ asset('site/user/assets/images/logo-icon.png') }}" alt="Logo"></a></li>
            </div>
            <!-- Header Logo End -->

            <!-- Header Search Start -->
            <div class="login-header-search dropdown">
                <button class="search-toggle" data-bs-toggle="dropdown"><i class="flaticon-loupe"></i></button>

                <div class="search-input dropdown-menu">
                    <form action="#">
                        <input type="text" placeholder="Search here">
                    </form>
                </div>

            </div>
            <!-- Header Search End -->

            <!-- Header Action Start -->
            <div class="login-header-action ml-auto">
                <div class="dropdown">
                    <button class="action notification" data-bs-toggle="dropdown">
                        <i class="flaticon-notification"></i>
                        <span class="active"></span>
                    </button>
                    <div class="dropdown-menu dropdown-notification">
                        <ul class="notification-items-list">
                            <li class="notification-item">
                                <span class="notify-icon bg-success text-white"><i class="icofont-ui-user"></i></span>
                                <div class="dropdown-body">
                                    <a href="#">
                                        <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                        </p>
                                    </a>
                                </div>
                                <span class="notify-time">3:20 am</span>
                            </li>
                            <li class="notification-item">
                                <span class="notify-icon bg-success text-white"><i class="icofont-shopping-cart"></i></span>
                                <div class="dropdown-body">
                                    <a href="#">
                                        <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                    </a>
                                </div>
                                <span class="notify-time">3:20 am</span>
                            </li>
                            <li class="notification-item">
                                <span class="notify-icon bg-danger text-white"><i class="icofont-book-mark"></i></span>
                                <div class="dropdown-body">
                                    <a href="#">
                                        <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                        </p>
                                    </a>
                                </div>
                                <span class="notify-time">3:20 am</span>
                            </li>
                            <li class="notification-item">
                                <span class="notify-icon bg-success text-white"><i class="icofont-heart-alt"></i></span>
                                <div class="dropdown-body">
                                    <a href="#">
                                        <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                    </a>
                                </div>
                                <span class="notify-time">3:20 am</span>
                            </li>
                            <li class="notification-item">
                                <span class="notify-icon bg-success text-white"><i class="icofont-image"></i></span>
                                <div class="dropdown-body">
                                    <a href="#">
                                        <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                        </p>
                                    </a>
                                </div>
                                <span class="notify-time">3:20 am</span>
                            </li>
                        </ul>
                        <a class="all-notification" href="#">See all notifications <i class="icofont-simple-right"></i></a>
                    </div>
                </div>

                <a class="action author" href="#">
                    <img src="{{ asset('site/user/assets/images/author/author-07.jpg') }}" alt="Author">
                </a>

                <div class="dropdown">
                    <button class="action more" data-bs-toggle="dropdown">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="" href="#"><i class="icofont-user"></i> Profile</a></li>
                        <li><a class="" href="#"><i class="icofont-inbox"></i> Inbox</a></li>
                        <li><a class="" href="#"><i class="icofont-logout"></i> Sign Out</a></li>
                    </ul>
                </div>
            </div>
            <!-- Header Action End -->

        </div>
        <!-- Login Header Wrapper End -->
    </div>
    <!-- Login Header End -->

    <!-- Courses Admin Start -->
    <div class="section overflow-hidden position-relative" id="wrapper">

        <!-- Sidebar Wrapper Start -->
        <div class="sidebar-wrapper">
            <div class="menu-list">
                <a class="{{ request()->routeIs('site.user.account') ? 'active' : '' }}" href="{{ route('site.user.account') }}"><img src="{{ asset('site/user/assets/images/menu-icon/icon-1.png') }}" alt="Icon"></a>
                <a href="messages.html"><img src="{{ asset('site/user/assets/images/menu-icon/icon-2.png') }}" alt="Icon"></a>
                <a href="overview.html"><img src="{{ asset('site/user/assets/images/menu-icon/icon-3.png') }}" alt="Icon"></a>
                <a href="engagement.html"><img src="{{ asset('site/user/assets/images/menu-icon/icon-4.png') }}" alt="Icon"></a>
                <a href="traffic-conversion.html"><img src="{{ asset('site/user/assets/images/menu-icon/icon-5.png') }}" alt="Icon"></a>
            </div>
        </div>
        <!-- Sidebar Wrapper End -->

        <div class="page-content-wrapper py-0">

            <!-- Admin Tab Menu Start -->
            <div class="nav flex-column admin-tab-menu">
                <a href="{{ route('site.user.account') }}" class="{{ request()->routeIs('site.user.account') ? 'active' : '' }}">Student’s</a>
                <a href="overview.html">Overview</a>
                <a href="reviews.html">Review’s</a>
                <a href="engagement.html">Course Engagement</a>
                <a href="traffic-conversion.html">Traffic & Conversion</a>
            </div>
            <!-- Admin Tab Menu End -->

            <!-- Page Content Wrapper Start -->
            @yield('site.user.content')
            <!-- Page Content Wrapper End -->

        </div>

    </div>
    <!-- Courses Admin End -->

    <!--Back To Start-->
    <a href="#" class="back-to-top">
        <i class="icofont-simple-up"></i>
    </a>
    <!--Back To End-->

</div>
<!-- Modernizer & jQuery JS -->
<script src="{{ asset('site/user/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
<script src="{{ asset('site/user/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('site/user/assets/js/plugins.min.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('site/user/assets/js/main.js') }}"></script>
<!-- Charts JS -->
<script src="{{ asset('site/user/assets/js/plugins/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('site/user/assets/js/plugins/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('site/user/assets/js/plugins/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('site/user/assets/js/student-map.js') }}"></script>
@yield('site.user.js')
</body>
</html>
