@extends('site.user.layouts.app')
@section('site.user.css')
    <style>
        .contact-action-item a {
            font-size: 15px;
            text-decoration: underline;
        }
        .is-invalid {
            border: 1px solid red !important;
        }
        .text-danger {
            font-size: 13px;
            margin-top: 4px;
        }
        .settings-wrapper .form-control{
            height:48px;
            border-radius:8px;
            border:1px solid #e5e7eb;
        }

        .settings-wrapper label{
            font-weight:500;
            margin-bottom:6px;
        }

        .settings-wrapper .btn-success{
            height:48px;
            border-radius:8px;
            padding:0 30px;
        }
        .settings-wrapper .card{
            border-radius:12px;
            border:none;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }
    </style>
@endsection
@section('site.user.content')
    <div {{--class="main-content-wrapper"--}}>
        <div class="container-fluid">

            <!-- Student Top Start -->
            <div class="admin-top-bar students-top">
                <div class="courses-select">

                    <h4 class="title">{{ __('site.settings') }}</h4>
                </div>
            </div>
            <!-- Student Top End -->

            <div class="settings-wrapper">
                <div class="card">
                    <div class="card-body">
                        <form id="settingsForm" action="{{ route('site.user.settingsUpdate',['locale' => app()->getLocale()]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('site.name') }}</label>
                                    <input type="text" name="name" class="form-control" value="{{ user()->name }}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('site.surname') }}</label>
                                    <input type="text" name="surname" class="form-control" value="{{ user()->surname }}">
                                    <span class="text-danger error-text surname_error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('site.email') }}</label>
                                    <input type="email" name="email" class="form-control" value="{{ user()->email }}">
                                    <span class="text-danger error-text email_error"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('site.phone') }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ user()->phone }}">
                                    <span class="text-danger error-text phone_error"></span>
                                </div>

                            </div>

                            <hr class="my-4">

                            <h6 class="mb-3">{{ __('site.password_resert') }}</h6>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('site.new_password') }}</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">{{ __('site.password_confirmation') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success px-4">
                                {{ __('site.save') }}
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('site.user.js')
    <script>
        $('#settingsForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);

            $('.error-text').text('');
            $('input').removeClass('is-invalid');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            $('input[name="'+key+'"]').addClass('is-invalid');
                            $('.'+key+'_error').text(value[0]);
                        });
                    }
                }
            });
        });
    </script>
@endsection
