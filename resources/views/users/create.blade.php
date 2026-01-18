@extends('layouts.app')
@section('title')
    {{ __('content.new') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
@endsection
@section('content')
    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.new') }}</h2>
            <div class="btn-box">
                <a href="{{ route('cms-users.index') }}" class="btn btn-sm btn-primary"> {{ __('content.cms_users') }}</a>
            </div>
        </div>
        @include('errors.messages')
        <div class="row">
            <form action="{{ route('cms-users.store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.username') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="username" value="{{ old('username') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.name') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.surname') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="surname" value="{{ old('surname') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.email') }}</label>
                                    <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.phone') }}</label>
                                    <input type="tel" class="form-control form-control-sm" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.pin') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="pin" value="{{ old('pin') }}">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.birthday') }}</label>
                                    <input type="text" class="form-control form-control-sm date-picker" name="birthday" value="{{ old('birthday') }}" placeholder="Y-m-d">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.password') }}</label>
                                    <input type="password" class="form-control form-control-sm" name="password">
                                </div>
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('validation.attributes.role') }}</label>
                                    <select class="form-control form-control-sm" data-placeholder="{{ __('content.choose') }}" name="roles">
                                        <option value="">{{ __('content.choose') }}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}" @if($role['id'] == old('roles')) selected @endif>{{ $role['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-sm btn btn-success">{{ __('content.save') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- main content end -->
@endsection
@section('js')
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
