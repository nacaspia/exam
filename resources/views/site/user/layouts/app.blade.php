<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{settings()['title'][language()] ?? null}} - {{ __('site.account') }}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . settings()['logo']['favicon']) }}">
    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('site/user/assets/css/vendor/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/user/assets/css/style.min.css') }}">
    @yield('site.user.css')
    <style>
        /* Header hündürlüyünə görə tənzimlə (məs: 80px) */
        #wrapper{
            min-height: calc(100vh - 80px);
            display: flex;
        }

        .sidebar-wrapper{
            height: auto;        /* 100% əvəzinə */
            min-height: calc(100vh - 80px);
        }

        .page-content-wrapper{
            flex: 1;
            min-height: calc(100vh - 80px);
        }
        /* Desktop default qalır */

        /* Mobil / tablet */
        @media (max-width: 991.98px) {
            /* wrapper flex düzülüşü dəyişsin */
            #wrapper{
                display: flex;
                flex-direction: column;
                min-height: calc(100vh - 80px); /* header hündürlüyünə görə */
            }

            /* sidebar artıq sol panel yox, üst menyu olsun */
            .sidebar-wrapper{
                width: 100%;
                height: auto;
                min-height: auto;
                position: relative;
                /*padding: 14px 0;*/
            }

            /* iconlar yan-yana düzülüb mərkəzdə dursun */
            .sidebar-wrapper .menu-list{
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 18px;
            }

            .sidebar-wrapper .menu-list a{
                display: inline-flex;
                justify-content: center;
                align-items: center;
                width: 54px;
                height: 54px;
                border-radius: 14px;
            }

            /* content soldan margin/padding almamalıdır */
            .page-content-wrapper{
                margin-left: 0 !important;
                width: 100%;
                min-height: 1px;
                padding-top: 10px;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper main-wrapper-02">

    <!-- Login Header Start -->
    <div class="section login-header">
        <!-- Login Header Wrapper Start -->
        <div class="login-header-wrapper navbar navbar-expand">

            <!-- Header Logo Start -->
            <div class="login-header-logo">
                <a href="{{ route('site.index', ['locale' => app()->getLocale()]) }}">
                    <img src="{{ asset('storage/' . settings()['logo']['header_logo']) }}" alt="{{settings()['title'][language()] ?? null}}" style="max-width: 58%;!important;">
                </a>
            </div>
            <!-- Header Logo End -->

            <!-- Header Search Start -->
            <div class="login-header-search dropdown">

            </div>
            <!-- Header Search End -->

            <!-- Header Action Start -->
            <div class="login-header-action ml-auto">
                <a class="action author" href="#">
                    <img src="{{ asset('site/user/assets/images/author/admin.png') }}" alt="{{ user()->name }}">
                </a>

                <div class="dropdown">
                    <button class="action more" data-bs-toggle="dropdown">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="" href="{{ route('site.user.settings',['locale' => app()->getLocale()]) }}"><i class="icofont-user"></i> {{ __('site.settings') }}</a></li>
{{--                        <li><a class="" href="#"><i class="icofont-inbox"></i> Inbox</a></li>--}}
                        <li><a class="" href="{{ route('site.user.logout', ['locale' => app()->getLocale()]) }}"><i class="icofont-logout"></i> {{ __('site.logout') }}</a></li>
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
                <a class="{{ request()->routeIs('site.user.account') ? 'active' : '' }}" href="{{ route('site.user.account',['locale' => app()->getLocale()]) }}"><img src="{{ asset('site/user/assets/images/menu-icon/icon-1.png') }}" alt="Icon"></a>
                <a class="{{ request()->routeIs('site.user.settings') ? 'active' : '' }}" href="{{ route('site.user.settings',['locale' => app()->getLocale()]) }}"><i class="icofont-user"></i> </a>
                <a class="{{ request()->routeIs('site.user.payments') ? 'active' : '' }}" href="{{ route('site.user.payments',['locale' => app()->getLocale()]) }}"><i class="icofont-pay"></i> </a>
                <a class="{{ request()->routeIs('site.user.logout') ? 'active' : '' }}"  href="{{ route('site.user.logout', ['locale' => app()->getLocale()]) }}"><i class="icofont-logout"></i></a>
           </div>
        </div>
        <!-- Sidebar Wrapper End -->

        <div class="page-content-wrapper py-0">

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
