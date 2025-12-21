@extends('layouts.app')
@section('title')
    {{ __('content.settings') }}
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
            <h2>{{ __('content.settings') }}</h2>
        </div>
        @include('errors.messages')
        <div class="row">
            <div class="col-12">

                <form action="@if(!empty($setting['id'])) {{ route('settings.update',$setting['id']) }} @else {{ route('settings.store') }} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($setting['id']))
                        @method('PUT')
                    @endif
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
                                        <span class="d-none d-sm-block">@lang('content.other')</span>
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
                                                    <label class="form-label">@lang('validation.attributes.title') - {{$lang['code']}}</label>
                                                    <input type="text" class="form-control js-title" name="title[{{$lang['code']}}]" value="{{$setting['title'][$lang['code']] ?? null}}" data-lang="{{$lang['code']}}">
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Qısa mətni ({{$lang['code']}})</label>
                                                    <textarea
                                                        class="form-control"
                                                        name="text[{{$lang['code']}}]"
                                                        rows="3">{{$setting['text'][$lang['code']] ?? null}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <div class="col-12">
                                                <label class="form-label">Facebook</label>
                                                <input type="text" class="form-control" name="facebook" value="{{$setting['contact']['facebook'] ?? null}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Instagram</label>
                                                <input type="text" class="form-control" name="instagram" value="{{$setting['contact']['instagram'] ?? null}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Telegram</label>
                                                <input type="text" class="form-control" name="telegram" value="{{$setting['contact']['telegram'] ?? null}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Linkedin</label>
                                                <input type="text" class="form-control" name="linkedin" value="{{$setting['contact']['linkedin'] ?? null}}">
                                            </div>
                                            <div class="col-lg-8 col-md-7">
                                                <div class="card component-jquery-uploader">
                                                    <div class="card-header">
                                                        @lang('validation.attributes.image')
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('validation.attributes.header_logo')</label>
                                                                <input type="file" name="header_logo" id="headerLogoUpload">
                                                                <p> Şəkilin maksimum ölçüsü  122×29 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                <div id="headerLogoPreview" style="margin-top: 10px;"></div>
                                                                <div class="col-md-5">
                                                                    @if(!empty($setting['logo']['header_logo']) && Storage::disk('public')->exists($setting['logo']['header_logo']))
                                                                        <img src="{{ asset('storage/' . $setting['logo']['header_logo']) }}"  style="width: 288px;!important;">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('validation.attributes.footer_logo')</label>
                                                                <input type="file" name="footer_logo" id="footerLogoUpload">
                                                                <p> Şəkilin maksimum ölçüsü  122×29 piksel olmalıdır. Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                <div id="footerLogoPreview" style="margin-top: 10px;"></div>
                                                                <div class="col-md-5">
                                                                    @if(!empty($setting['logo']['footer_logo']) && Storage::disk('public')->exists($setting['logo']['footer_logo']))
                                                                        <img src="{{ asset('storage/' . $setting['logo']['footer_logo']) }}"  style="width: 288px;!important;">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('validation.attributes.favicon')</label>
                                                                <input type="file" name="favicon" id="faviconUpload">
                                                                <div id="faviconPreview" style="margin-top: 10px;"></div>
                                                                <div class="col-md-5">
                                                                    @if(!empty($setting['logo']['favicon']) && Storage::disk('public')->exists($setting['logo']['header_logo']))
                                                                        <img src="{{ asset('storage/' . $setting['logo']['favicon']) }}"  style="width: 288px;!important;">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">@lang('content.save')</button>
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
            document.getElementById('headerLogoUpload').addEventListener('change', function (event) {
                const headerLogoPreview = document.getElementById('headerLogoPreview');
                headerLogoPreview.innerHTML = ''; // Önizleme alanını temizle
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
                    headerLogoPreview.appendChild(img);
                }
            });
            document.getElementById('footerLogoUpload').addEventListener('change', function (event) {
                const footerLogoPreview = document.getElementById('footerLogoPreview');
                footerLogoPreview.innerHTML = ''; // Önizleme alanını temizle
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
                    footerLogoPreview.appendChild(img);
                }
            });
            document.getElementById('faviconUpload').addEventListener('change', function (event) {
                const faviconPreview = document.getElementById('faviconPreview');
                faviconPreview.innerHTML = ''; // Önizleme alanını temizle
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
                    faviconPreview.appendChild(img);
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
