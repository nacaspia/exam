@extends('layouts.app')
@section('title')
    {{ __('content.home') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>CRM Dashboard</h2>
            <div class="input-group dashboard-filter">
                <input type="text" class="form-control" name="basic" id="dashboardFilter" readonly>
                <label for="dashboardFilter" class="input-group-text"><i class="fa-light fa-calendar-days"></i></label>
            </div>
        </div>
        <div class="row mb-25">
            <div class="col-lg-3 col-6 col-xs-12">
                <div class="dashboard-top-box d-block rounded border-0 panel-bg">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <div class="right">
                            <div class="part-icon text-light rounded">
                                <span><i class="fa-light fa-user-plus"></i></span>
                            </div>
                        </div>
                        <div class="left">
                            <h3 class="fw-normal">134,152</h3>
                        </div>
                    </div>
                    <div class="progress-box">
                        <p class="d-flex justify-content-between mb-1">Active Client <small>+116.24%</small></p>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 col-xs-12">
                <div class="dashboard-top-box d-block rounded border-0 panel-bg">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <div class="right">
                            <div class="part-icon text-light rounded">
                                <span><i class="fa-light fa-user-secret"></i></span>
                            </div>
                        </div>
                        <div class="left">
                            <h3 class="fw-normal">134,152</h3>
                        </div>
                    </div>
                    <div class="progress-box">
                        <p class="d-flex justify-content-between mb-1">Active Admin <small>56.24%</small></p>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 col-xs-12">
                <div class="dashboard-top-box d-block rounded border-0 panel-bg">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <div class="right">
                            <div class="part-icon text-light rounded">
                                <span><i class="fa-light fa-money-bill"></i></span>
                            </div>
                        </div>
                        <div class="left">
                            <h3 class="fw-normal">134,152</h3>
                        </div>
                    </div>
                    <div class="progress-box">
                        <p class="d-flex justify-content-between mb-1">Total Expenses <small>+16.24%</small></p>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 col-xs-12">
                <div class="dashboard-top-box d-block rounded border-0 panel-bg">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <div class="right">
                            <div class="part-icon text-light rounded">
                                <span><i class="fa-light fa-file"></i></span>
                            </div>
                        </div>
                        <div class="left">
                            <h3 class="fw-normal">134,152</h3>
                        </div>
                    </div>
                    <div class="progress-box">
                        <p class="d-flex justify-content-between mb-1">Running Projects <small>+16.24%</small></p>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
