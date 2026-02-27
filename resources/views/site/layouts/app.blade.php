<!doctype html>
<html lang="{{ app()->currentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('site.meta')
    <!--====== Title ======-->
    <title>{{settings()['title'][language()] ?? null}} - @yield('site.title')</title>
    <link rel="shortcut icon" href="{{ asset('storage/' . settings()['logo']['favicon']?? null) }}" type="image/png">
    @yield('site.css')
    <style>
        .language-switcher select {
            border: 1px solid #ddd;
            padding: 5px 8px;
            border-radius: 6px;
            background: #f8f9fa;
            cursor: pointer;
        }
        .footer-bottom {
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .footer-bottom p {
            margin: 0;
            color: #d3d3d3;
            font-size: 14px;
        }

        .footer-bottom a {
            color: #4db5ff;
            font-weight: 600;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<!--====== PRELOADER PART START ======-->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
</div>
<header class="header-area">
    <div class="header-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-5">
                    <div class="header-logo d-flex align-items-center justify-content-center justify-content-sm-start">
                        <div class="logo">
                            <a href="{{ route('site.index', ['locale' => app()->getLocale()]) }}">
                                <img src="{{ asset('storage/' . settings()['logo']['header_logo']?? null) }}" alt="{{settings()['title'][language()] ?? null}}">
                            </a>
                        </div>
                        <form class="d-none d-md-inline-block"  method="GET" action="{{ route('site.search',['locale'=>app()->getLocale()]) }}">
                            <div class="input-box">
                                <i class="fal fa-search"></i>
                                <input type="text" name="search" placeholder="{{ __('site.search_exam') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-7">
                    <div class="header-btns d-flex align-items-center justify-content-center justify-content-sm-end">

                        <ul>
                            @if(!empty(user()))
                                <li><a href="{{ route('site.user.account', ['locale' => app()->getLocale()]) }}"><i class="fal fa-user"></i>{{ __('site.account') }}</a></li>
                            @else
                                <li><a href="{{ route('site.auth.login', ['locale' => app()->getLocale()]) }}"><i class="fal fa-key"></i> {{ __('site.login') }}</a></li>
                            @endif
                        </ul>
                        <!-- Dil seçimi -->

                        <div class="trial-btns d-none d-lg-block">
                            <a href="#">{{ __('site.contact_us') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="navigation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFive" aria-controls="navbarFive" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button> <!-- navbar toggler -->
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarFive">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('site.exams', ['locale' => app()->getLocale()]) }}">{{ __('site.exams') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('site.subjects', ['locale' => app()->getLocale()]) }}">{{ __('site.subjects') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('site.classes', ['locale' => app()->getLocale()]) }}">{{ __('site.classes') }}</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="page-scroll" href="{{ route('site.achievements', ['locale' => app()->getLocale()]) }}">{{ __('site.achievements') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('site.blogs', ['locale' => app()->getLocale()]) }}">{{ __('site.blogs') }}</a>
                                    </li>--}}
                                </ul>
                            </div>

                            <div class="language-switcher ms-3" style="padding: 2px!important;">
                                <select onchange="window.location.href='/' + this.value">
                                    @foreach(languages() as $lang)
                                        <option value="{{$lang['code']}}" {{ app()->getLocale() == $lang['code'] ? 'selected' : '' }}>{{$lang['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="navbar-item d-flex align-items-center">
                                <div class="menu-icon d-none d-lg-block">
                                    <ul>
                                        <li><a href="{{settings()['contact']['facebook'] ?? null}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{settings()['contact']['instagram'] ?? null}}"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="{{settings()['contact']['telegram'] ?? null}}"><i class="fab fa-telegram"></i></a></li>
                                        <li><a href="{{settings()['contact']['linkedin'] ?? null}}"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>
    </div>
</header>

<!--====== HEADER PART ENDS ======-->
@yield('site.content')

<footer class="footer-area">
    <div class="footer-bottom">
        <a href="{{ route('site.about', ['locale' => app()->getLocale()]) }}">{{ __('site.about_us') }}</a>
        <a href="{{ route('site.contact', ['locale' => app()->getLocale()]) }}">{{ __('site.contact') }}</a>
        <a href="{{ route('site.privacy-policy', ['locale' => app()->getLocale()]) }}">{{ __('site.privacy_policy') }}</a>
        <p>
            Müəllif hüquqları qorunur. By
            <a href="https://nacaspia.com" target="_blank"> NACaspia Informaion Technologies MMC</a>
        </p>
    </div>
</footer>

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TOP ======-->
<div class="back-to-top">
    <a href="#">
        <i class="fal fa-chevron-double-up"></i>
    </a>
</div>
@yield('site.js')
</body>
</html>
