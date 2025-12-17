@extends('layouts.app')
@section('title')
    {{ __('content.new') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery.uploader.cs') }}s">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/material-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
@endsection
@section('content')
    <div class="main-content">

        @include('errors.messages')
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.new') }}</h2>
            <div class="btn-box">
                <a href="{{ route('roles.index') }}" target="_blank" class="btn btn-sm btn-primary">{{ __('content.roles') }}</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row g-3">
                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                    <label class="form-label">{{ __('content.title') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12  add-product-sidebar">
                    <div class="panel">
                        <div class="panel-header">
                            <h5>{{ __('content.permission_labels') }}</h5>
                            <div class="btn-box d-flex gap-2">
                                <button class="btn btn-sm btn-icon btn-outline-primary panel-close"><i class="fa-light fa-angle-up"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="product-categories">
                                @foreach($permissionLabels as $label)
                                    <div class="cat-group">
                                        <div class="form-check">
                                            <input class="form-check-input has-sub" type="checkbox" id="label{{$label['id']}}">
                                            <label class="form-check-label" for="label{{$label['id']}}">
                                                {{ __('content.'.$label['name']) }} <span><i class="fa-light fa-plus"></i></span>
                                            </label>
                                        </div>
                                        <div class="sub-cat-group">
                                            @foreach($label['permissions'] as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" name="permissions[]"  value="{{ $permission['id'] }}" type="checkbox" id="cat{{$permission['permission_label_id']}}">
                                                    <label class="form-check-label" for="cat{{$permission['permission_label_id']}}">
                                                        {{ __('content.'.$permission['name']) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="border-top"></div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn btn-success">{{ __('content.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Üst checkbox və label klik
            document.querySelectorAll('.cat-group .form-check-label').forEach(label => {
                label.addEventListener('click', function (e) {
                    // checkbox-u al
                    const parentRow = this.closest('.cat-group');
                    const parentCheckbox = parentRow.querySelector('.form-check-input.has-sub');

                    // Kliklə seç/çıxarılan kimi toggle et
                    parentCheckbox.checked = !parentCheckbox.checked;
                    parentCheckbox.dispatchEvent(new Event('change')); // digərlərini də tetikle
                });
            });

            // Top (label) checkbox click event
            document.querySelectorAll('.form-check-input.has-sub').forEach(parentCheck => {
                parentCheck.addEventListener('change', function () {

                    let catGroup = this.closest('.cat-group');
                    let childChecks = catGroup.querySelectorAll('.sub-cat-group .form-check-input');

                    childChecks.forEach(child => {
                        child.checked = parentCheck.checked;
                    });

                });
            });


            // When child changes, update parent automatically
            document.querySelectorAll('.sub-cat-group .form-check-input').forEach(childCheck => {
                childCheck.addEventListener('change', function () {

                    let catGroup = this.closest('.cat-group');
                    let parentCheck = catGroup.querySelector('.form-check-input.has-sub');
                    let childChecks = catGroup.querySelectorAll('.sub-cat-group .form-check-input');

                    let allSelected = true;
                    childChecks.forEach(child => {
                        if (!child.checked) allSelected = false;
                    });

                    parentCheck.checked = allSelected;
                });
            });

        });

    </script>
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.uploader.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
    <script src="{{ asset('assets/js/add-product.js') }}"></script>
@endsection
