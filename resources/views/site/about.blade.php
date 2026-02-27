@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.about_us') }}
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
    <section class="access-area pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="access-content">
                        <div class="access-title">
                            <h3 class="title">{{ __('site.about_us') }}</h3>
                        </div>
                        <div class="access-mission">
                            <h4 class="title">piyayimlari.az  1–12-ci sinif şagirdləri üçün Azərbaycan, Rus və İngilis bölmələrində onlayn imtahan və qiymətləndirmə xidmətləri təqdim edən rəqəmsal təhsil platformasıdır.</h4>
                            <p>
                                Platformanın məqsədi:
                                Şagirdlərin bilik səviyyəsini obyektiv və şəffaf şəkildə qiymətləndirmək
                                Onlayn imtahan prosesini təhlükəsiz və texnoloji cəhətdən etibarlı mühitdə təşkil etmək
                                Valideyn və müəllimlər üçün dəqiq nəticə və analiz imkanları təqdim etmək
                                Platforma fərdi sahibkar Eldəniz Tariverdiyev (VÖEN: 7701971982) tərəfindən idarə olunur və tam onlayn əsasda fəaliyyət göstərir.
                                Sistem müasir texnologiyalar əsasında hazırlanmışdır və aşağıdakı imkanları təmin edir:
                                Təhlükəsiz onlayn ödəniş sistemi
                                Avtomatik nəticə hesablanması
                                Statistik analiz və nəticə hesabatı
                                piyayimlari.az təhsildə keyfiyyət, dürüstlük və texnoloji inkişaf prinsiplərini əsas tutur.
                            </p>
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
