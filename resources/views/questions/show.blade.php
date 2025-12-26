@extends('layouts.app')
@section('title')
    {{ __('content.edit') }}
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
            <h2>{{ __('content.edit') }}</h2>
            <div class="btn-box">
                <a href="{{ route('questions.index') }}" class="btn btn-sm btn-primary"> {{ __('content.questions') }}</a>
            </div>
        </div>
        @include('errors.messages')
        <div class="row">
            <div class="col-12">
                <form action="{{ route('questions.update',$question['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                                    <input type="text" class="form-control js-title" name="title[{{$lang['code']}}]" value="{{ $question['title'][$lang['code']] }}" data-lang="{{$lang['code']}}">
                                                </div>


                                                <div class="col-12">
                                                    <label class="form-label">Sual mətni ({{$lang['code']}})</label>
                                                    <textarea
                                                        class="form-control"
                                                        name="text[{{$lang['code']}}]"
                                                        rows="3">{{ $question['text'][$lang['code']] ?? null }}</textarea>
                                                </div>
                                                {{-- SEO TITLE --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Meta title ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-meta-title"
                                                           name="meta_title[{{$lang['code']}}]" value="{{ $question['seo']['meta_title'][$lang['code']] ?? null }}"
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
                                                              placeholder="Boş burax → title-dan auto dolacaq" data-lang="{{$lang['code']}}">{{ $question['seo']['meta_text'][$lang['code']] ?? null }}</textarea>
                                                </div>

                                                {{-- SEO KEYWORDS --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Meta keywords ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-meta-keyword"
                                                           name="meta_keywords[{{$lang['code']}}]" value="{{ $question['seo']['meta_keywords'][$lang['code']] ?? null }}"
                                                           placeholder="keyword1, keyword2" data-lang="{{$lang['code']}}">
                                                </div>

                                                {{-- OG TITLE --}}
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        OG title ({{$lang['code']}})
                                                    </label>
                                                    <input type="text"
                                                           class="form-control js-og-title"
                                                           name="og_title[{{$lang['code']}}]" value="{{ $question['seo']['og_title'][$lang['code']] ?? null }}"
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
                                                              placeholder="Boş burax → meta description-dan götürüləcək" data-lang="{{$lang['code']}}">{{ $question['seo']['og_text'][$lang['code']] ?? null }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">

                                        {{-- SUBJECT --}}
                                        <div class="col-md-12">
                                            <label class="form-label">Fənn</label>
                                            <select name="subject_id" class="form-select" required>
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject['id'] }}" @if($class['id'] === $question['subject_id']) selected @endif>{{ $subject['name'][language()] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- TYPE --}}
                                        <div class="col-md-12">
                                            <label class="form-label">Sual növü</label>
                                            <select name="type" id="questionType" class="form-select" required>
                                                <option value="">Seçin</option>
                                                <option value="multiple_choice" @if($question['type'] === 'multiple_choice') selected @endif>Variantlı</option>
                                                <option value="short_text" @if($question['type'] === 'short_text') selected @endif>Qısa yazı</option>
                                                <option value="open_text"  @if($question['type'] === 'open_text') selected @endif>Açıq sual</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12" id="multipleChoiceBlock">
                                            <hr>
                                            <h5>Variantlar</h5>

                                            <div id="optionsWrapper"></div>

                                            <button type="button" class="btn btn-sm btn-success mt-2" id="addOption">
                                                + Variant əlavə et
                                            </button>
                                        </div>
                                        <div class="col-md-12" id="shortTextBlock" style="display:none">
                                            <label class="form-label">Doğru cavab</label>
                                            <input type="text"
                                                   name="correct_answer"
                                                   class="form-control"
                                                   value="{{ $question['answer']['correct_answer'][language()] ?? '' }}">
                                        </div>
                                        {{-- CANONICAL --}}
                                        <div class="col-12">
                                            <label class="form-label">Canonical URL</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="canonical_url" value="{{ $question['seo']['canonical_url'] ?? null }}"
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
                                                       @if(!empty($question['seo']['index'])) checked @endif>
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
                                                       @if(!empty($question['seo']['follow']) && $question['seo']['follow']) checked @endif>
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
                                                                <div class="col-md-5">
                                                                    @if($question['image'] && Storage::disk('public')->exists($question['image']))
                                                                        <img src="{{ asset('storage/' . $question['image']) }}"  style="width: 288px;!important;">
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
        const EXISTING_OPTIONS = @json($question['options'] ?? []);
        const EXISTING_TYPE = "{{ $question['type'] }}";
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let optionIndex = 0;
            const MAX_OPTIONS = 5;

            const typeSelect = document.getElementById('questionType');
            const mcBlock = document.getElementById('multipleChoiceBlock');
            const shortBlock = document.getElementById('shortTextBlock');
            const addBtn = document.getElementById('addOption');
            const wrapper = document.getElementById('optionsWrapper');

            function resetOptions() {
                optionIndex = 0;
                wrapper.innerHTML = '';
                addBtn.disabled = false;
            }

            function toggleBlocks() {
                mcBlock.style.display = 'none';
                shortBlock.style.display = 'none';

                if (typeSelect.value === 'multiple_choice') {
                    mcBlock.style.display = 'block';
                }

                if (typeSelect.value === 'short_text') {
                    shortBlock.style.display = 'block';
                }

                if (typeSelect.value !== 'multiple_choice') {
                    resetOptions();
                }
            }

            function addOption(option = null) {
                if (optionIndex >= MAX_OPTIONS) return;

                let html = `
        <div class="card mt-2 p-3">
            <div class="row">
                @foreach(languages() as $lang)
                <div class="col-md-4">
                    <input type="text"
                        name="options[${optionIndex}][{{$lang['code']}}]"
                        class="form-control"
                        value="${option?.option?.['{{$lang['code']}}'] ?? ''}"
                        placeholder="Variant ({{$lang['code']}})">
                </div>
                @endforeach
                <div class="col-md-2">
                    <label>
                        <input type="radio"
                               name="correct_option"
                               value="${optionIndex}"
                               ${option?.is_correct ? 'checked' : ''}>
                        Doğru
                    </label>
                </div>
            </div>
        </div>`;

                wrapper.insertAdjacentHTML('beforeend', html);
                optionIndex++;

                if (optionIndex >= MAX_OPTIONS) {
                    addBtn.disabled = true;
                }
            }

            // Add button
            addBtn.addEventListener('click', function () {
                addOption();
            });

            // Type change
            typeSelect.addEventListener('change', toggleBlocks);

            // =====================
            // ✏️ EDIT MODE
            // =====================
            if (EXISTING_TYPE === 'multiple_choice' && EXISTING_OPTIONS.length) {
                mcBlock.style.display = 'block';
                EXISTING_OPTIONS.forEach(opt => addOption(opt));
            }

            if (EXISTING_TYPE === 'short_text') {
                shortBlock.style.display = 'block';
            }

            toggleBlocks();
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
