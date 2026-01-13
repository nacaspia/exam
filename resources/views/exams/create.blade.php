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
                <a href="{{ route('exams.index') }}" class="btn btn-sm btn-primary"> {{ __('content.exams') }}</a>
            </div>
        </div>
        @include('errors.messages')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control js-title" name="title[{{$lang['code']}}]" data-lang="{{$lang['code']}}">
                                                </div>


                                                <div class="col-12">
                                                    <label class="form-label">Sual mətni ({{$lang['code']}})</label>
                                                    <textarea
                                                        class="form-control"
                                                        name="text[{{$lang['code']}}]"
                                                        rows="3"></textarea>
                                                </div>
                                                {{-- SEO TITLE --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Meta title ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-meta-title"
                                                           name="meta_title[{{$lang['code']}}]"
                                                           placeholder="Boş burax → title-dan auto dolacaq" data-lang="{{$lang['code']}}">
                                                </div>

                                                {{-- SEO DESCRIPTION --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Meta description ({{$lang['code']}})
                                                    </label>
                                                    <textarea class="form-control js-meta-text"
                                                              name="meta_text[{{$lang['code']}}]"
                                                              rows="3"
                                                              placeholder="Boş burax → title-dan auto dolacaq" data-lang="{{$lang['code']}}"></textarea>
                                                </div>

                                                {{-- SEO KEYWORDS --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Meta keywords ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-meta-keyword"
                                                           name="meta_keywords[{{$lang['code']}}]"
                                                           placeholder="keyword1, keyword2" data-lang="{{$lang['code']}}">
                                                </div>

                                                {{-- OG TITLE --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        OG title ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-og-title"
                                                           name="og_title[{{$lang['code']}}]"
                                                           placeholder="Boş burax → meta title-dan götürüləcək" data-lang="{{$lang['code']}}">
                                                </div>

                                                {{-- OG DESCRIPTION --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        OG description ({{$lang['code']}})
                                                    </label>
                                                    <textarea class="form-control js-og-text"
                                                              name="og_text[{{$lang['code']}}]"
                                                              rows="2"
                                                              placeholder="Boş burax → meta description-dan götürüləcək" data-lang="{{$lang['code']}}"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">

                                        {{-- CLASS --}}
                                        <div class="col-md-12">
                                            <label class="form-label">Sinif</label>
                                            <select name="class_id" class="form-select" required>
                                                @foreach($schoolClasses as $class)
                                                    <option value="{{ $class['id'] }}">{{ $class['name'][language()] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- LANGUAGE --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Exam Language</label>
                                            <select name="language" class="form-select" required>
                                                @foreach(languages() as $lang)
                                                    <option value="{{ $lang->code }}">{{ $lang->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- PRICE --}}
                                        <div class="col-md-4">
                                            <label class="form-label">Qiymət</label>
                                            <input type="number" name="price" class="form-control" min="0" step="0.01">
                                        </div>

                                        {{-- DURATION --}}
                                        <div class="col-md-4">
                                            <label class="form-label">Müddət (dəq)</label>
                                            <input type="number" name="duration" class="form-control" min="1" required>
                                        </div>

                                        {{-- QUESTION COUNT --}}
                                        <div class="col-md-4">
                                            <label class="form-label">Sual sayı</label>
                                            <input type="number" name="question_count" class="form-control" min="1" required>
                                        </div>

                                        {{-- START TIME --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Başlama vaxtı</label>
                                            <input type="text" name="start_time" class="form-control datetimepicker">
                                        </div>

                                        {{-- END TIME --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Bitmə vaxtı</label>
                                            <input type="text" name="end_time" class="form-control datetimepicker">
                                        </div>

                                        {{-- FLAGS --}}
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="random_questions" value="1" checked>
                                                <label class="form-check-label">Random suallar</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Sualları seç</label>
                                            <select name="question_ids[]" id="questionsSelect" class="form-select" multiple="multiple" required title="Secin">
                                                @foreach($questions as $question)
                                                    <option value="{{ $question->id }}">
                                                        {{ $question->title[app()->getLocale()] ?? $question->title['en'] ?? 'No Title' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small>Ctrl/Shift ilə bir neçə sual seçə bilərsiniz</small>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="show_result" value="1" checked>
                                                <label class="form-check-label">Nəticəni göstər</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="active" value="1" checked>
                                                <label class="form-check-label">Aktiv</label>
                                            </div>
                                        </div>

                                        {{-- DESCRIPTION --}}
                                        <div class="col-12">
                                            <label class="form-label">Təsvir</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                        {{-- CANONICAL --}}
                                        <div class="col-12">
                                            <label class="form-label">Canonical URL</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="canonical_url"
                                                   placeholder="https://site.az/az/questions">
                                        </div>

                                        {{-- INDEX --}}
                                        <div class="col-12">
                                            <input type="hidden" name="index" value="0">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="index"
                                                       value="1"
                                                       checked>
                                                <label class="form-check-label">
                                                    Index
                                                </label>
                                            </div>
                                        </div>

                                        {{-- FOLLOW --}}
                                        <div class="col-12">
                                            <input type="hidden" name="follow" value="0">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="follow"
                                                       value="1"
                                                       checked>
                                                <label class="form-check-label">
                                                    Follow
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-lg-8 col-md-7">
                                                <div class="card component-jquery-uploader">
                                                    <div class="card-header">
                                                        @lang('validation.attributes.image')
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">


                                                            <div class="col-xxl-9 col-sm-8">
                                                                <label class="form-label">@lang('validation.attributes.image')</label>
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
        $(document).ready(function() {
            $('#questionsSelect').select2({
                placeholder: "Sualları seçin...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datetimepicker", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const slugify = text =>
                text
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .substring(0, 70);

            document.querySelectorAll('.js-title').forEach(titleInput => {

                titleInput.addEventListener('input', () => {
                    const lang = titleInput.dataset.lang;
                    const value = titleInput.value.trim();

                    if (!value) return;

                    const metaTitle = document.querySelector(`.js-meta-title[data-lang="${lang}"]`);
                    const metaKeyword = document.querySelector(`.js-meta-keyword[data-lang="${lang}"]`);
                    const metaText  = document.querySelector(`.js-meta-text[data-lang="${lang}"]`);
                    const ogTitle   = document.querySelector(`.js-og-title[data-lang="${lang}"]`);
                    const ogText    = document.querySelector(`.js-og-text[data-lang="${lang}"]`);

                    if (metaTitle && !metaTitle.dataset.touched) {
                        metaTitle.value = value;
                    }
                    if (metaKeyword && !metaKeyword.dataset.touched) {
                        metaKeyword.value = value;
                    }

                    if (metaText && !metaText.dataset.touched) {
                        metaText.value = value.substring(0, 160);
                    }

                    if (ogTitle && !ogTitle.dataset.touched) {
                        ogTitle.value = value;
                    }

                    if (ogText && !ogText.dataset.touched) {
                        ogText.value = value.substring(0, 160);
                    }
                });

            });

            // 👇 Admin əl ilə dəyişəndə auto-stop
            document.querySelectorAll(
                '.js-meta-title, .js-meta-text, .js-og-title, .js-og-text'
            ).forEach(input => {
                input.addEventListener('input', () => {
                    input.dataset.touched = true;
                });
            });

        });
    </script>

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
