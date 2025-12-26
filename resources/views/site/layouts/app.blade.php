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
    <link rel="shortcut icon" href="{{ asset('storage/' . settings()['logo']['favicon']) }}" type="image/png">
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
                                <img src="{{ asset('storage/' . settings()['logo']['header_logo']) }}" alt="{{settings()['title'][language()] ?? null}}">
                            </a>
                        </div>
                        <form class="d-none d-md-inline-block" action="#">
                            <div class="input-box">
                                <i class="fal fa-search"></i>
                                <input type="text" placeholder="{{ __('site.search_exam') }}">
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
                                    {{--<option value="az" {{ app()->getLocale() == 'az' ? 'selected' : '' }}>AZ</option>
                                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                                    <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>RU</option>--}}
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
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="footer-item mt-30">
                    <div class="footer-title item-2">
                        <i class="fal fa-book"></i>
                        <h4 class="title">{{ __('site.site_name') }}</h4>
                        <p>{{ __('site.site_content') }}</p>
                    </div>
                    <div class="footer-list-area">
                        <div class="footer-list justify-content-between pr-30 d-block d-sm-flex">
                            <ul>
                                <li><a href="{{ route('site.about', ['locale' => app()->getLocale()]) }}"><i class="fal fa-angle-right"></i> {{ __('site.about_us') }}</a></li>
                                <li><a href="{{ route('site.faqs', ['locale' => app()->getLocale()]) }}"><i class="fal fa-angle-right"></i> {{ __('site.faqs') }}</a></li>
                                <li><a href="{{ route('site.contact', ['locale' => app()->getLocale()]) }}"><i class="fal fa-angle-right"></i> {{ __('site.contact') }}</a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('site.terms-conditions', ['locale' => app()->getLocale()]) }}"><i class="fal fa-angle-right"></i> {{ __('site.terms_conditions') }}</a></li>
                                <li><a href="{{ route('site.privacy-policy', ['locale' => app()->getLocale()]) }}"><i class="fal fa-angle-right"></i> {{ __('site.privacy_policy') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-item mt-30">
                    <div class="footer-title item-3">
                        <i class="fal fa-magic"></i>
                        <h4 class="title">{{ __('site.site_post') }}</h4>
                    </div>
                    <div class="footer-instagram">
                        <div class="instagram-item d-flex">
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                        </div>
                        <div class="instagram-item d-flex">
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                        </div>
                        <div class="instagram-item d-flex">
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                            <div class="item">
                                <img src="{{ asset('site/assets/images/instagram-1.jpg') }}" alt="instagram">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
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
