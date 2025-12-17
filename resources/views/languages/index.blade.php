@extends('layouts.app')
@section('title')
    {{ __('content.languages') }}
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
    <div class="dashboard-breadcrumb mb-25">
        <h2>@lang('content.languages')</h2>
    </div>
    @include('errors.messages')
    <div class="row g-4">
        <div class="col-xxl-4 col-md-5">
            <div class="panel">
                <div class="panel-header">
                    <h5>@lang('admin.add')</h5>
                </div>
                <div class="panel-body">
                    <form action="{{ route('languages.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">@lang('content.lang')</label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="col-12">
                                <label class="form-label">@lang('content.code')</label>
                                <input type="text" class="form-control" name="code">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">@lang('content.icon')</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">@lang('content.status')</label>
                                <select class="form-control" name="status">
                                    <option value="1">Aktiv</option>
                                    <option value="0">Deactiv</option>
                                </select>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="btn-box">
                                    <button class="btn btn-primary w-100 login-btn">@lang('content.save')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-md-7">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-dashed table-hover digi-dataTable all-product-table table-striped"
                           id="allProductTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('content.code')</th>
                            <th>@lang('content.lang')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($languages[0]) && isset($languages[0]))
                            @foreach($languages as $key => $value)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td>
                                        <div class="table-category-card">
                                            @if(!empty($value['image']))
                                                <div class="part-icon">
                                                 <span>
                                                     <img
                                                         src="{{ asset('uploads/languages/'.$value['image']) }}">
                                                 </span>
                                                </div>
                                            @endif
                                            <div class="part-txt">
                                                <span class="category-name">{{ ucfirst($value['code']) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="table-bottom-control"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
