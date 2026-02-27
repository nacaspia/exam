@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.contact_us') }}
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
                            <h3 class="title">{{ __('site.contact_us') }}</h3>
                        </div>
                        <div class="access-mission">
                            <p>
                                Platforma ilə bağlı sual, texniki problem və ya ödəniş müraciətləri üçün
                                bizimlə aşağıdakı vasitələrlə əlaqə saxlaya bilərsiniz:
                            </p>

                            <ul>
                                <li><strong>Fərdi sahibkar:</strong> Eldəniz Tariverdiyev</li>
                                <li><strong>VÖEN:</strong> 7701971982</li>
                                <li><strong>Email:</strong> piyayimlari@gmail.com</li>
                                <li><strong>Telefon (WhatsApp):</strong> +994 55 569 49 25</li>
                                <li><strong>Veb sayt:</strong> www.piyayimlari.az</li>
                            </ul>

                            <p>
                                Müraciətlərə mümkün qədər qısa müddətdə, adətən 1–2 iş günü ərzində cavab verilir.
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
