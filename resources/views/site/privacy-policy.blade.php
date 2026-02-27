@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.privacy_policy') }}
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
                            <h3 class="title">Məxfilik Siyasəti</h3>
                            <p><strong>Son yenilənmə tarixi:</strong> 27 Mart 2026</p>
                        </div>

                        <div class="access-mission">

                            <p>
                                Bu Məxfilik Siyasəti piyayimlari.az platformasından istifadə edən şəxslərin
                                məlumatlarının toplanması, saxlanılması və qorunması qaydalarını müəyyən edir.
                                Platformadan istifadə etməklə siz bu siyasətin şərtlərini qəbul etmiş olursunuz.
                            </p>

                            <h4>1. Toplanan Məlumatlar</h4>
                            <ul>
                                <li>Ad və soyad</li>
                                <li>Email ünvanı</li>
                                <li>Telefon nömrəsi</li>
                                <li>Ödəniş məlumatları (ödəmə provayderi vasitəsilə)</li>
                                <li>IP ünvanı və cihaz məlumatları</li>
                                <li>İmtahan nəticələri və fəaliyyət tarixçəsi</li>
                            </ul>
                            <p><strong>Qeyd:</strong> Platforma istifadəçilərin bank kartı məlumatlarını birbaşa saxlamır.</p>

                            <h4>2. Məlumatların İstifadə Məqsədi</h4>
                            <ul>
                                <li>İstifadəçi hesabının yaradılması və idarə olunması</li>
                                <li>İmtahan xidmətlərinin təqdim edilməsi</li>
                                <li>Ödənişlərin emalı</li>
                                <li>Təhlükəsizliyin təmin edilməsi və anti-cheat nəzarəti</li>
                                <li>Statistik analiz və sistemin təkmilləşdirilməsi</li>
                            </ul>

                            <h4>3. Məlumatların Qorunması</h4>
                            <ul>
                                <li>SSL şifrələmə texnologiyası</li>
                                <li>Təhlükəsiz server infrastrukturu</li>
                                <li>Giriş nəzarəti və log monitorinq sistemi</li>
                            </ul>

                            <h4>4. Üçüncü Tərəflərlə Paylaşım</h4>
                            <p>
                                Şəxsi məlumatlar aşağıdakı hallar istisna olmaqla üçüncü tərəflərlə paylaşılmır:
                            </p>
                            <ul>
                                <li>Qanuni tələb olduqda</li>
                                <li>Ödəniş əməliyyatlarının həyata keçirilməsi məqsədilə ödəmə provayderi ilə</li>
                                <li>Texniki xidmət göstərən tərəfdaşlarla (məxfilik öhdəliyi əsasında)</li>
                            </ul>

                            <h4>5. İstifadəçi Hüquqları</h4>
                            <ul>
                                <li>Öz şəxsi məlumatlarına baxmaq</li>
                                <li>Düzəliş etmək</li>
                                <li>Hesabın silinməsini tələb etmək</li>
                            </ul>

                            <h4>6. Dəyişikliklər</h4>
                            <p>
                                Platforma bu Məxfilik Siyasətinə dəyişiklik etmək hüququnu saxlayır.
                                Yenilənmiş versiya saytda dərc edildiyi tarixdən qüvvəyə minir.
                            </p>

                            <hr class="mt-5 mb-5">

                            <div class="access-title">
                                <h3 class="title">Refund Policy (Geri Qaytarma Siyasəti)</h3>
                            </div>

                            <h4>1. Ümumi Qayda</h4>
                            <p>
                                Platformada təqdim edilən xidmətlər rəqəmsal məhsul hesab olunur.
                                İmtahana giriş təmin edildikdən sonra ödəniş geri qaytarılmır.
                            </p>

                            <h4>2. Geri Qaytarma Mümkün Hallar</h4>
                            <ul>
                                <li>Ödəniş iki dəfə tutulubsa</li>
                                <li>Texniki nasazlıq səbəbilə imtahan təmin edilməyibsə</li>
                                <li>Ödəniş alınıb, lakin sistem imtahanı aktivləşdirməyibsə</li>
                            </ul>

                            <h4>3. Müraciət Qaydası</h4>
                            <p>
                                Refund müraciəti 3 iş günü ərzində
                                <strong>piyayimlari@gmail.com</strong> ünvanına
                                ödəniş sübutu ilə birlikdə göndərilməlidir.
                            </p>

                            <h4>4. Qərar və Qaytarma Müddəti</h4>
                            <p>
                                Refund müraciətinə 5 iş günü ərzində baxılır.
                                Təsdiq edildiyi halda məbləğ 7–14 iş günü ərzində geri qaytarılır.
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
