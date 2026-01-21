@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.forgot_password') }}
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
    <style>
        .contact-action-item a {
            font-size: 15px;
            text-decoration: underline;
        }

    </style>
@endsection
@section('site.content')
    <section class="contact-action-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-action-item">
                        <h6 class="title">{{ __('site.forgot_password') }}</h6>
                        <form id="forgotPasswordForm" method="POST" action="{{ route('site.password.update',['locale' => app()->getLocale()]) }}">
                            @csrf
                            <div class="input-box mt-20">
                                <input name="new_password" type="password" placeholder="{{ __('site.new_password') }}">
                                <i class="fal fa-lock"></i>
                                <span class="text-danger error-text new_password_error"></span>
                            </div>
                            <div class="input-box mt-20">
                                <input name="password_confirmation" type="password" placeholder="{{ __('site.password_confirmation') }}">
                                <i class="fal fa-lock"></i>
                                <span class="text-danger error-text password_confirmation_error"></span>
                            </div>
                            <div id="formAlert" class="alert" style="display:none"></div>
                            <div class="input-box mt-20">
                                <button type="submit">{{ __('site.send') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="map">
            <img src="{{ asset('site/assets/images/contact-info-thumb-1.jpg') }}" width="600" height="450" style="border:0;" alt="info">
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
    <script>
        $('#forgotPasswordForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            $('#formAlert').hide().removeClass('alert-success alert-danger').text('');
            $('.error-text').text('');
            $('input').removeClass('is-invalid');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {

                        $('#formAlert')
                            .addClass('alert-success')
                            .text(response.messages ?? 'Əməliyyat uğurla tamamlandı')
                            .show();

                        // istəsən redirect
                        // setTimeout(() => window.location.href = response.redirect, 1500);
                    } else {
                        $('#formAlert')
                            .addClass('alert-danger')
                            .text(response.errors?.[0] ?? 'Xəta baş verdi')
                            .show();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            $('input[name="'+key+'"]').addClass('is-invalid');
                            $('.'+key+'_error').text(value[0]);
                        });
                    } else {
                        // Digər xətalar
                        $('#formAlert')
                            .addClass('alert-danger')
                            .text(xhr.responseJSON?.errors?.[0] ?? 'Sistem xətası baş verdi')
                            .show();
                    }
                }
            });
        });
    </script>
@endsection
