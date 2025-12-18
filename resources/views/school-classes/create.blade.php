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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .input-group-text {
            cursor: pointer;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

    </style>
@endsection
@section('content')
    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.new') }}</h2>
            <div class="btn-box">
                <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-primary"> {{ __('content.subjects') }}</a>
            </div>
        </div>
        @include('errors.messages')
        <div class="row">
                <div class="col-12">
                    <form action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel">
                            <div class="panel-body">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    @if(!empty(languages()))
                                        @foreach(languages() as $key => $lang)
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link @if(++$key ==1) active @endif" data-bs-toggle="tab"
                                                   href="#{{$lang->code}}" role="tab">
                                                    <span class="d-none d-sm-block">{{$lang->code}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab"
                                           href="#other" role="tab">
                                            <span class="d-none d-sm-block">@lang('admin.other')</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @if(!empty(languages()))
                                        @foreach(languages() as $key => $lang)
                                            <div class="tab-pane @if(++$key ==1) active @endif" id="{{$lang['code']}}"
                                                 role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">@lang('admin.title') - {{$lang['code']}}</label>
                                                        <input type="text" class="form-control" name="title[{{$lang['code']}}]">
                                                    </div>
                                                    {{--<div class="col-12">
                                                        <label class="form-label">@lang('admin.text') - {{$lang['code']}}</label>
                                                        <textarea class="form-control" type="text" name="text[{{$lang['code']}}]" ></textarea>
                                                    </div>--}}
                                                    <div class="col-12">
                                                        <label class="form-label">@lang('admin.full_text') - {{$lang['code']}}</label>
                                                        <textarea class="editor form-control"
                                                                  data-locale="{{ $lang['code'] }}"
                                                                  data-csrf-token="{{ csrf_token() }}"
                                                                  name="fulltext[{{$lang['code']}}]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="tab-pane" id="other" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-sm-12">
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="card component-jquery-uploader">
                                                        <div class="card-header">
                                                            @lang('admin.images')
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xxl-9 col-sm-8">
                                                                    <label class="form-label">@lang('admin.main_image')</label>
                                                                    <input type="file" name="image" id="mainImageUpload">
                                                                    <p> Şəkilin maksimum ölçüsü  1228x1228 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                    <div id="mainImagePreview" style="margin-top: 10px;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">@lang('admin.save')</button>
                            </div>
                        </div>
                    </form>
                </div>

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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Tek resim için: Dosya adını göster
            document.getElementById('mainImageUpload').addEventListener('change', function (event) {
                const mainImagePreview = document.getElementById('mainImagePreview');
                mainImagePreview.innerHTML = ''; // Önizleme alanını temizle
                const file = event.target.files[0];
                if (file) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file); // Resmin src'sini ayarla
                    img.style.width = '150px';
                    img.style.height = 'auto';
                    img.style.border = '1px solid #ccc';
                    img.style.padding = '5px';
                    img.style.marginTop = '5px';

                    // Önizleme alanına resmi ekle
                    mainImagePreview.appendChild(img);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var errorDiv = document.getElementById('error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 2000);
        });
    </script>
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/editor_summernote.js') }}"></script>
@endsection
