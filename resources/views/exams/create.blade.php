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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .input-group-text {
            cursor: pointer;
        }

        .input-group-text i {
            font-size: 1.2rem;
        }

    </style>
    <style>
        /* CKEditor "this version is not secure" xəbərdarlığını gizlədirik */
        .cke_notification {
            display: none !important;
        }
    </style>

@endsection

@section('content')
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
                    <input type="file" id="editorImageUploader" accept="image/*" style="display:none;">
                    <div class="panel">
                        <div class="panel-body">
                            {{-- TAB NAV --}}
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                {{--@foreach(languages() as $key => $lang)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if($key==0) active @endif" data-bs-toggle="tab"
                                           href="#{{$lang->code}}" role="tab">
                                            <span class="d-none d-sm-block">{{$lang->code}}</span>
                                        </a>
                                    </li>
                                @endforeach--}}
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab"
                                       href="#az" role="tab">
                                        <span class="d-none d-sm-block">Məlumat</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#questions" role="tab">
                                        <span class="d-none d-sm-block">@lang('content.questions')</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#other" role="tab">
                                        <span class="d-none d-sm-block">@lang('content.other')</span>
                                    </a>
                                </li>
                            </ul>

                            {{-- TAB CONTENT --}}
                            <div class="tab-content p-3 text-muted">
                                {{-- LANGUAGE TABS --}}
                                {{--@foreach(languages() as $key => $lang)
                                    <div class="tab-pane fade @if($key==0) show active @endif" id="{{$lang['code']}}"
                                         role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">@lang('validation.attributes.title')
                                                    - {{$lang['code']}}</label>
                                                <input type="text" class="form-control js-title"
                                                       name="title[{{$lang['code']}}]" data-lang="{{$lang['code']}}">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Sual mətni ({{$lang['code']}})</label>
                                                <textarea id="text_{{$lang['code']}}"
                                                          class="ckeditor4 form-control"
                                                          name="text[{{$lang['code']}}]"></textarea>
                                            </div>

                                            --}}{{-- SEO --}}{{--
                                            <div class="col-12">
                                                <label class="form-label">Meta title ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-meta-title"
                                                       name="meta_title[{{$lang['code']}}]"
                                                       placeholder="Boş burax → title-dan auto dolacaq"
                                                       data-lang="{{$lang['code']}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Meta description ({{$lang['code']}})</label>
                                                <textarea class="form-control js-meta-text"
                                                          name="meta_text[{{$lang['code']}}]" rows="3"
                                                          placeholder="Boş burax → title-dan auto dolacaq"
                                                          data-lang="{{$lang['code']}}"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Meta keywords ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-meta-keyword"
                                                       name="meta_keywords[{{$lang['code']}}]"
                                                       placeholder="keyword1, keyword2" data-lang="{{$lang['code']}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">OG title ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-og-title"
                                                       name="og_title[{{$lang['code']}}]"
                                                       placeholder="Boş burax → meta title-dan götürüləcək"
                                                       data-lang="{{$lang['code']}}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">OG description ({{$lang['code']}})</label>
                                                <textarea class="form-control js-og-text"
                                                          name="og_text[{{$lang['code']}}]" rows="2"
                                                          placeholder="Boş burax → meta description-dan götürüləcək"
                                                          data-lang="{{$lang['code']}}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach--}}

                                <div class="tab-pane fade show active" id="az"
                                     role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Imtahan başlıqı</label>
                                            <input type="text" class="form-control js-title"
                                                   name="title[az]" data-lang="az" value="{{ old('title.az') }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">İmtahan haqqda</label>

                                            <textarea id="text_az"
                                                      class="ckeditor4 form-control"
                                                      name="text[az]">{{ old('text.az') }}</textarea>
                                        </div>

                                        {{-- SEO --}}
                                        <div class="col-12">
                                            <label class="form-label">Meta title </label>
                                            <input type="text" class="form-control js-meta-title"
                                                   name="meta_title[az]"
                                                   placeholder="Boş burax → title-dan auto dolacaq"
                                                   data-lang="az" value="{{ old('meta_title.az') }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Meta description (az)</label>
                                            <textarea class="form-control js-meta-text"
                                                      name="meta_text[az]" rows="3"
                                                      placeholder="Boş burax → title-dan auto dolacaq"
                                                      data-lang="az">{{ old('meta_text.az') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Meta keywords (az)</label>
                                            <input type="text" class="form-control js-meta-keyword"
                                                   name="meta_keywords[az]"
                                                   placeholder="keyword1, keyword2" data-lang="az" value="{{ old('meta_keywords.az') }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">OG title (az)</label>
                                            <input type="text" class="form-control js-og-title"
                                                   name="og_title[az]"  value="{{ old('og_title.az') }}"
                                                   placeholder="Boş burax → meta title-dan götürüləcək"
                                                   data-lang="az">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">OG description (az)</label>
                                            <textarea class="form-control js-og-text"
                                                      name="og_text[az]" rows="2"
                                                      placeholder="Boş burax → meta description-dan götürüləcək"
                                                      data-lang="az">{{ old('og_text.az') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- QUESTIONS TAB --}}
                                <div class="tab-pane fade" id="questions" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5>İmtahan sualları</h5>
                                        <button type="button" class="btn btn-sm btn-success" id="addQuestionBtn">+ Sual
                                            əlavə et
                                        </button>
                                    </div>
                                    <div id="questionsWrapper"></div>

                                    {{-- QUESTION TEMPLATE --}}
                                    <template id="questionTemplate">
                                        <div class="card mb-3 question-item">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <strong class="question-head">Sual</strong>
                                                <button type="button" class="btn btn-sm btn-danger remove-question">
                                                    Sil
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <ul class="nav nav-pills mb-3 question-tabs" role="tablist">
                                                    {{--@foreach(languages() as $k => $lang)
                                                        <li class="nav-item" role="presentation">
                                                            <button
                                                                class="nav-link @if($k==0) active @endif question-lang-tab"
                                                                type="button" data-bs-toggle="tab"
                                                                data-lang="{{ $lang->code }}"
                                                                data-bs-target="#"> {{ strtoupper($lang->code) }} </button>
                                                        </li>
                                                    @endforeach--}}
                                                    <li class="nav-item" role="presentation">
                                                        <button
                                                            class="nav-link active question-lang-tab"
                                                            type="button" data-bs-toggle="tab"
                                                            data-lang="az"
                                                            data-bs-target="#"> {{ strtoupper('az') }} </button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link question-other-tab" type="button"
                                                                data-bs-toggle="tab" data-bs-target="#"> Digər
                                                        </button>
                                                    </li>
                                                </ul>

                                                <div class="tab-content question-tab-content">
                                                    {{--@foreach(languages() as $k => $lang)
                                                        <div
                                                            class="tab-pane fade @if($k==0) show active @endif question-lang-pane"
                                                            data-lang="{{ $lang->code }}" role="tabpanel">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <label class="form-label">Başlıq ({{ $lang->code }}
                                                                        )</label>
                                                                    <input type="text" class="form-control q-title"
                                                                           data-lang="{{ $lang->code }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label">Mətn ({{ $lang->code }}
                                                                        )</label>
                                                                    <textarea class="form-control q-text ck-question-text" rows="4"
                                                                              data-lang="{{ $lang->code }}"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach--}}
                                                    <div
                                                        class="tab-pane fade show active question-lang-pane"
                                                        data-lang="az" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label class="form-label">Sual başlıqı
                                                                    )</label>
                                                                <input type="text" class="form-control q-title"
                                                                       data-lang="az">
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Sual haqqda ətraflı mətn
                                                                    )</label>
                                                                <textarea class="form-control q-text ck-question-text" rows="4"
                                                                          data-lang="az"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- OTHER --}}
                                                    <div class="tab-pane fade question-other-pane" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Fənn</label>
                                                                <select class="form-select subject-select">
                                                                    <option value="">Seçin</option>
                                                                    @foreach($subjects as $subject)
                                                                        <option
                                                                            value="{{ $subject['id'] }}">{{ $subject['name'][language()] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Sual növü</label>
                                                                <select class="form-select type-select">
                                                                    <option value="">Seçin</option>
                                                                    <option value="multiple_choice">Variantlı</option>
                                                                    <option value="short_text">Açıq sual</option>
                                                                </select>
                                                            </div>

                                                            {{-- MULTIPLE CHOICE --}}
                                                            <div class="col-12 multiple-choice-block"
                                                                 style="display:none">
                                                                <hr>
                                                                <h6>Variantlar</h6>
                                                                <div class="options-wrapper"></div>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-outline-success add-option">
                                                                    + Variant əlavə et
                                                                </button>
                                                            </div>

                                                            {{-- SHORT TEXT --}}
                                                            <div class="col-12 short-text-block" style="display:none">
                                                                <label class="form-label">Doğru cavab</label>

                                                                <textarea class="ckeditor4 form-control  correct-answer ck-question-correct-answer" rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    {{-- OPTION TEMPLATE --}}
                                    <template id="optionTemplate">
                                        <div class="row g-2 align-items-start option-item mb-3">
                                            <div class="col-md-1">
                                                <label class="form-label fw-bold option-label">A)</label>
                                            </div>

                                            <div class="col-md-7">
                                                <textarea class="form-control option-text ck-option-text"
                                                          data-lang="az"
                                                          rows="3"
                                                          placeholder="Cavabı qeyd edin"></textarea>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-check" style="margin-top: 10px;">
                                                    <input type="radio" class="form-check-input correct-option-radio">
                                                    <label class="form-check-label">Düzgün cavab</label>
                                                </div>
                                            </div>

                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-sm btn-danger remove-option" style="margin-top: 5px;">
                                                    Sil
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                   {{-- <template id="optionTemplate">
                                        <div class="row g-2 align-items-center option-item mb-2">
                                            --}}{{--@foreach(languages() as $lang)
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control option-text"
                                                           data-lang="{{ $lang->code }}"
                                                           placeholder="Variant ({{ $lang->code }})">
                                                </div>
                                            @endforeach--}}{{--
                                            <div class="col-md-5">

                                                <input type="text" class="form-control option-text"
                                                       data-lang="az"
                                                       placeholder="Cavabı qeyd edin">
                                            </div>
                                            <div class="col-md-1 text-center">
                                                <input type="radio" class="form-check-input correct-option-radio">
                                                Düzgün cavabı qeyd edin
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-sm btn-danger remove-option">Sil
                                                </button>
                                            </div>
                                        </div>
                                    </template>--}}
                                </div>

                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3"> {{-- CLASS --}}
                                        <div class="col-md-6"><label class="form-label">Sinif</label>
                                            <select name="class_id" class="form-select" required>
                                                @foreach($schoolClasses as $class)
                                                    <option
                                                        value="{{ $class['id'] }}" @if($class['id'] == old('class_id')) selected="selected" @endif>{{ $class['name'][language()] }}</option>
                                                @endforeach </select>
                                        </div> {{-- LANGUAGE --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Dil</label>
                                            <select name="language" class="form-select" required>
                                                @foreach(languages() as $lang)
                                                    <option value="{{ $lang->code }}"  @if($lang->code == old('language')) selected="selected" @endif>{{ $lang->code }}</option>
                                                @endforeach
                                            </select>
                                        </div> {{-- PRICE --}}
                                        <div class="row g-3">
                                            {{-- PRICE TYPE --}}
                                            <div class="col-md-3">
                                                <label class="form-label">Qiymət növü (Pullu)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input price-type" type="radio"
                                                           name="price_type" value="paid" id="pricePaid"  @if(old('price_type') == 'paid') checked="checked" @endif>
                                                    <label class="form-check-label" for="pricePaid">Pullu</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Qiymət növü (Pulsuz)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input price-type" type="radio"
                                                           name="price_type" value="free" id="priceFree" @if(old('price_type') == 'free') checked="checked" @endif>
                                                    <label class="form-check-label" for="priceFree">Pulsuz</label>
                                                </div>
                                            </div>

                                            {{-- PRICE --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Qiymət</label>
                                                <input type="number" name="price" class="form-control price-input"
                                                       min="0" step="0.01" value="{{ old('price') }}">
                                            </div>

                                            {{-- DURATION TYPE --}}
                                            <div class="col-md-3">
                                                <label class="form-label">Müddət növü (Müddətli)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input duration-type" type="radio"
                                                           name="duration_type" value="timed" id="durationTimed" @if(old('duration_type') == 'timed') checked="checked" @endif>
                                                    <label class="form-check-label" for="durationTimed">Müddətli</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Müddət növü (Müddətsiz)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input duration-type" type="radio"
                                                           name="duration_type" value="untimed" id="durationUntimed"  @if(old('duration_type') == 'untimed') checked="checked" @endif>
                                                    <label class="form-check-label"
                                                           for="durationUntimed">Müddətsiz</label>
                                                </div>
                                            </div>

                                            {{-- DURATION --}}
                                            <div class="col-md-6 duration-field">
                                                <label class="form-label">Müddət (dəq)</label>
                                                <input type="number" name="duration" class="form-control" min="1" value="{{ old('duration') }}">
                                            </div>

                                            {{-- START TIME --}}
                                            <div class="col-md-6 start-time-field">
                                                <label class="form-label">Başlama vaxtı</label>
                                                <input type="text" name="start_time"  value="{{ old('start_time') }}"
                                                       class="form-control datetimepicker">
                                            </div>

                                            {{-- END TIME --}}
                                            <div class="col-md-6 end-time-field">
                                                <label class="form-label">Bitmə vaxtı</label>
                                                <input type="text" name="end_time" class="form-control datetimepicker"   value="{{ old('end_time') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="show_result"
                                                       value="1" @if(old('show_result') == 1) checked="checked" @endif>
                                                <label class="form-check-label">Nəticəni göstər</label>
                                            </div>
                                        </div>
                                        @if(cms_user()->hasPermission('exams-active'))
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="active"
                                                           value="1"  @if(old('active') == 1) checked="checked" @endif>
                                                    <label class="form-check-label">Aktiv</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Canonical URL</label>
                                                <input type="text" class="form-control" name="canonical_url"
                                                       placeholder="https://site.az/az/questions" value="{{ old('canonical_url') }}">
                                            </div> {{-- INDEX --}}
                                            <div class="col-12">
                                                <input type="hidden" name="index" value="0" @if(old('index') == 0) checked="checked" @endif>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="index"
                                                           value="1" @if(old('index') == 1) checked="checked" @endif>
                                                    <label class="form-check-label"> Index </label>
                                                </div>
                                            </div> {{-- FOLLOW --}}
                                            <div class="col-12"><input type="hidden" name="follow" value="0">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                                               name="follow" value="1" @if(old('follow') == 1) checked="checked" @endif> <label
                                                        class="form-check-label"> Follow </label></div>
                                            </div>
                                        @endif {{-- DESCRIPTION --}}
                                        <div class="col-sm-12">
                                            <div class="col-lg-8 col-md-7">
                                                <div class="card component-jquery-uploader">
                                                    <div
                                                        class="card-header"> @lang('validation.attributes.image') </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xxl-9 col-sm-8"><label
                                                                    class="form-label">@lang('validation.attributes.image')</label>
                                                                <input type="file" name="image" id="mainImageUpload">
                                                                <p> Şəkilin maksimum ölçüsü 1228x1228 piksel olmalıdır.
                                                                    Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>
                                                                <div id="mainImagePreview"
                                                                     style="margin-top: 10px;"></div>
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        window.oldQuestions = @json(old('questions', []));
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function () {
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        });
    </script>
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const style = document.createElement('style');
            style.innerHTML = `.cke_notification { display: none !important; }`;
            document.head.appendChild(style);

            if (!CKEDITOR.plugins.get('customimageupload')) {
                CKEDITOR.plugins.add('customimageupload', {
                    init: function (editor) {
                        editor.addCommand('openImageUploader', {
                            exec: function (editor) {
                                const input = document.getElementById('editorImageUploader');
                                if (!input) {
                                    alert('editorImageUploader tapılmadı');
                                    return;
                                }

                                input.setAttribute('data-editor-id', editor.name);
                                input.value = '';
                                input.click();
                            }
                        });

                        editor.ui.addButton('CustomImageUpload', {
                            label: 'Şəkil əlavə et',
                            command: 'openImageUploader',
                            toolbar: 'insert',
                            icon: 'image'
                        });
                    }
                });
            }

            window.initEditor = function (el, height = 300) {
                if (!el) return;

                if (!el.id) {
                    el.id = 'editor_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
                }

                if (CKEDITOR.instances[el.id]) {
                    return;
                }

                CKEDITOR.replace(el.id, {
                    height: height,
                    extraPlugins: 'mathjax,customimageupload',
                    removePlugins: 'image,uploadimage,image2',
                    mathJaxLib: 'https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=TeX-AMS_HTML',

                    allowedContent: true,
                    extraAllowedContent: 'img[*]{*}(*)',

                    toolbar: [
                        { name: 'document', items: ['Source'] },
                        { name: 'clipboard', items: ['Undo', 'Redo'] },
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                        { name: 'insert', items: ['CustomImageUpload', 'Table', 'Mathjax'] },
                        { name: 'links', items: ['Link', 'Unlink'] },
                        { name: 'styles', items: ['Format', 'FontSize'] },
                        { name: 'tools', items: ['Maximize'] }
                    ],

                    on: {
                        doubleclick: function (evt) {
                            const element = evt.data.element;

                            if (element && element.is('img')) {
                                let currentWidth = element.getStyle('width') || '';
                                let currentHeight = element.getStyle('height') || '';

                                currentWidth = currentWidth.replace('px', '');
                                currentHeight = currentHeight.replace('px', '');

                                let newWidth = prompt('Yeni en (px)', currentWidth || '400');
                                let newHeight = prompt('Yeni hündürlük (px, boş qoysan auto olacaq)', currentHeight || '');

                                if (newWidth && newWidth.trim() !== '') {
                                    element.setStyle('width', newWidth.trim() + 'px');
                                    element.removeStyle('max-width');
                                } else {
                                    element.removeStyle('width');
                                    element.setStyle('max-width', '100%');
                                }

                                if (newHeight && newHeight.trim() !== '') {
                                    element.setStyle('height', newHeight.trim() + 'px');
                                } else {
                                    element.removeStyle('height');
                                    element.setStyle('height', 'auto');
                                }
                            }
                        }
                    }
                });
            };

            window.initQuestionEditors = function (card, qIndex) {
                card.querySelectorAll('.ck-question-text').forEach(el => window.initEditor(el, 200));
                card.querySelectorAll('.ck-question-correct-answer').forEach(el => window.initEditor(el, 200));
                card.querySelectorAll('.ck-option-text').forEach(el => window.initEditor(el, 120));
            };

            document.querySelectorAll('.ckeditor4').forEach(el => window.initEditor(el, 300));

            const uploader = document.getElementById('editorImageUploader');

            if (uploader) {
                uploader.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const editorId = e.target.getAttribute('data-editor-id');
                    const editor = CKEDITOR.instances[editorId];

                    if (!editor) {
                        alert('Editor tapılmadı');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('upload', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch("{{ route('ckeditor.upload') }}", {
                        method: 'POST',
                        body: formData
                    })
                        .then(res => res.json())
                        .then(response => {
                            if (response.uploaded && response.url) {
                                let width = prompt('Şəklin eni (px)', '400');
                                let height = prompt('Şəklin hündürlüyü (px, boş qoysan auto olacaq)', '');

                                width = width ? width.trim() : '';
                                height = height ? height.trim() : '';

                                let style = 'display:block;';

                                if (width) {
                                    style += `width:${width}px;`;
                                } else {
                                    style += 'max-width:100%;';
                                }

                                if (height) {
                                    style += `height:${height}px;`;
                                } else {
                                    style += 'height:auto;';
                                }

                                editor.focus();
                                editor.insertHtml(`<p><img src="${response.url}" alt="" style="${style}"></p>`);
                            } else {
                                alert(response?.error?.message || 'Şəkil əlavə olunmadı');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            alert('Upload zamanı xəta baş verdi');
                        });
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const priceRadios = document.querySelectorAll(".price-type");
            const priceInput = document.querySelector(".price-input");

            const durationRadios = document.querySelectorAll(".duration-type");
            const durationField = document.querySelector(".duration-field");
            const startTimeField = document.querySelector(".start-time-field");
            const endTimeField = document.querySelector(".end-time-field");

            // Qiymət toggle
            priceRadios.forEach(radio => {
                radio.addEventListener("change", function () {
                    if (this.value === "paid") {
                        priceInput.disabled = false;
                    } else {
                        priceInput.disabled = true;
                        priceInput.value = '';
                    }
                });
            });

            // Müddət toggle
            durationRadios.forEach(radio => {
                radio.addEventListener("change", function () {
                    if (this.value === "timed") {
                        durationField.style.display = "block";
                        startTimeField.style.display = "block";
                        endTimeField.style.display = "block";
                    } else {
                        durationField.style.display = "none";
                        startTimeField.style.display = "none";
                        endTimeField.style.display = "none";
                        durationField.querySelector("input").value = '';
                        startTimeField.querySelector("input").value = '';
                        endTimeField.querySelector("input").value = '';
                    }
                });
            });

            // Səhifə yüklənəndə ilkin vəziyyət
            const checkedPrice = document.querySelector('input[name="price_type"]:checked');
            const checkedDuration = document.querySelector('input[name="duration_type"]:checked');

            if (checkedPrice) {
                checkedPrice.dispatchEvent(new Event('change'));
            }

            if (checkedDuration) {
                checkedDuration.dispatchEvent(new Event('change'));
            }
            // document.querySelector('input[name="price_type"]:checked').dispatchEvent(new Event('change'));
            // document.querySelector('input[name="duration_type"]:checked').dispatchEvent(new Event('change'));
        });
        document.addEventListener("DOMContentLoaded", function () {

            let questionIndex = 0;
            const questionsWrapper = document.getElementById("questionsWrapper");
            const addQuestionBtn = document.getElementById("addQuestionBtn");
            const questionTemplate = document.getElementById("questionTemplate");
            const optionTemplate = document.getElementById("optionTemplate");

            function toggleBlocks(card) {
                const type = card.querySelector(".type-select").value;
                card.querySelector(".multiple-choice-block").style.display = type === "multiple_choice" ? "block" : "none";
                card.querySelector(".short-text-block").style.display = type === "short_text" ? "block" : "none";
            }

            function getOptionLetter(index) {
                return String.fromCharCode(65 + index);
            }

            function refreshOptionNames(card, qIndex) {
                const options = card.querySelectorAll(".option-item");

                options.forEach((opt, optIndex) => {
                    const label = opt.querySelector(".option-label");
                    if (label) {
                        label.innerText = getOptionLetter(optIndex) + ")";
                    }

                    opt.querySelectorAll(".option-text").forEach(input => {
                        const lang = input.dataset.lang;
                        input.name = `questions[${qIndex}][options][${optIndex}][${lang}]`;
                    });

                    const radio = opt.querySelector(".correct-option-radio");
                    radio.name = `questions[${qIndex}][correct_option]`;
                    radio.value = optIndex;
                });
            }

            function refreshNames(card, qIndex) {
                card.querySelector(".subject-select").name = `questions[${qIndex}][subject_id]`;
                card.querySelector(".type-select").name = `questions[${qIndex}][type]`;

                card.querySelectorAll(".q-title").forEach(input => {
                    input.name = `questions[${qIndex}][title][${input.dataset.lang}]`;
                });

                card.querySelectorAll(".q-text").forEach(input => {
                    input.name = `questions[${qIndex}][text][${input.dataset.lang}]`;
                });

                card.querySelector(".correct-answer").name = `questions[${qIndex}][correct_answer]`;

                refreshOptionNames(card, qIndex);
            }

            function setEditorDataWhenReady(textarea, value, retry = 0) {
                if (!textarea) return;

                const maxRetry = 50;

                if (textarea.id && CKEDITOR.instances[textarea.id]) {
                    CKEDITOR.instances[textarea.id].setData(value ?? '');
                    return;
                }

                textarea.value = value ?? '';

                if (retry < maxRetry) {
                    setTimeout(() => {
                        setEditorDataWhenReady(textarea, value, retry + 1);
                    }, 100);
                }
            }

            function addOption(card, qIndex, optionData = null, isCorrect = false) {
                const node = optionTemplate.content.cloneNode(true);
                card.querySelector(".options-wrapper").appendChild(node);

                const addedOption = card.querySelector(".options-wrapper .option-item:last-child");

                if (addedOption) {
                    const textarea = addedOption.querySelector('.option-text[data-lang="az"]');
                    const radio = addedOption.querySelector('.correct-option-radio');

                    if (radio && isCorrect) {
                        radio.checked = true;
                    }

                    addedOption.querySelectorAll('.ck-option-text').forEach(el => window.initEditor(el, 120));

                    setEditorDataWhenReady(textarea, optionData?.az ?? '');
                }

                refreshOptionNames(card, qIndex);
            }

            function reIndexAllQuestions() {
                const allCards = questionsWrapper.querySelectorAll(".question-item");

                allCards.forEach((card, index) => {
                    card.querySelector(".question-head").innerText = `Sual #${index + 1}`;
                    refreshNames(card, index);
                });

                questionIndex = allCards.length;
            }

            function addQuestion(questionData = null) {
                const currentIndex = questionIndex;
                const node = questionTemplate.content.cloneNode(true);
                const card = node.querySelector(".question-item");
                questionsWrapper.appendChild(card);

                initQuestionEditors(card, currentIndex);

                const uniqueId = "qtab_" + Date.now() + "_" + Math.floor(Math.random() * 1000);
                const langButtons = card.querySelectorAll(".question-lang-tab");
                const otherButton = card.querySelector(".question-other-tab");
                const otherPane = card.querySelector(".question-other-pane");

                langButtons.forEach(btn => {
                    const lang = btn.dataset.lang;
                    const paneId = `${uniqueId}_lang_${lang}`;
                    btn.setAttribute("data-bs-target", `#${paneId}`);
                    const pane = card.querySelector(`.question-lang-pane[data-lang="${lang}"]`);
                    if (pane) {
                        pane.id = paneId;
                    }
                });

                const otherPaneId = `${uniqueId}_other`;
                otherButton.setAttribute("data-bs-target", `#${otherPaneId}`);
                otherPane.id = otherPaneId;

                refreshNames(card, currentIndex);

                if (questionData) {
                    const qTitle = card.querySelector('.q-title[data-lang="az"]');
                    if (qTitle) {
                        qTitle.value = questionData?.title?.az ?? '';
                    }

                    const subjectSelect = card.querySelector('.subject-select');
                    if (subjectSelect) {
                        subjectSelect.value = questionData?.subject_id ?? '';
                    }

                    const typeSelect = card.querySelector('.type-select');
                    if (typeSelect) {
                        typeSelect.value = questionData?.type ?? '';
                    }
                }

                toggleBlocks(card);

                if (questionData) {
                    const qText = card.querySelector('.q-text[data-lang="az"]');
                    setEditorDataWhenReady(qText, questionData?.text?.az ?? '');

                    const correctAnswer = card.querySelector('.correct-answer');
                    setEditorDataWhenReady(correctAnswer, questionData?.correct_answer ?? '');

                    if (questionData?.type === 'multiple_choice' && questionData?.options) {
                        const optionsWrapper = card.querySelector(".options-wrapper");
                        optionsWrapper.innerHTML = '';

                        Object.entries(questionData.options).forEach(([optIndex, optionValue]) => {
                            addOption(
                                card,
                                currentIndex,
                                optionValue,
                                String(questionData.correct_option) === String(optIndex)
                            );
                        });
                    } else if (questionData?.type === 'multiple_choice') {
                        for (let i = 0; i < 4; i++) {
                            addOption(card, currentIndex);
                        }
                    }
                }

                card.querySelector(".type-select").addEventListener("change", function () {
                    toggleBlocks(card);

                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);

                    if (this.value === "multiple_choice" && card.querySelectorAll(".option-item").length === 0) {
                        for (let i = 0; i < 4; i++) {
                            addOption(card, qIndex);
                        }
                    }
                });

                card.querySelector(".add-option").addEventListener("click", function () {
                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                    addOption(card, qIndex);
                });

                card.querySelector(".remove-question").addEventListener("click", function () {
                    card.querySelectorAll('textarea').forEach(textarea => {
                        if (textarea.id && CKEDITOR.instances[textarea.id]) {
                            CKEDITOR.instances[textarea.id].destroy(true);
                        }
                    });

                    card.remove();
                    reIndexAllQuestions();
                });

                card.addEventListener("click", function (e) {
                    if (e.target.classList.contains("remove-option")) {
                        const optionItem = e.target.closest(".option-item");

                        optionItem.querySelectorAll('textarea').forEach(textarea => {
                            if (textarea.id && CKEDITOR.instances[textarea.id]) {
                                CKEDITOR.instances[textarea.id].destroy(true);
                            }
                        });

                        optionItem.remove();
                        reIndexAllQuestions();
                    }
                });

                questionIndex++;
                reIndexAllQuestions();
            }

            addQuestionBtn.addEventListener("click", function () {
                addQuestion();
            });

            if (window.oldQuestions && window.oldQuestions.length > 0) {
                window.oldQuestions.forEach(question => addQuestion(question));
            } else {
                addQuestion();
            }
        });
        /*document.addEventListener("DOMContentLoaded", function () {

            let questionIndex = 0;
            const questionsWrapper = document.getElementById("questionsWrapper");
            const addQuestionBtn = document.getElementById("addQuestionBtn");
            const questionTemplate = document.getElementById("questionTemplate");
            const optionTemplate = document.getElementById("optionTemplate");

            function toggleBlocks(card) {
                const type = card.querySelector(".type-select").value;
                card.querySelector(".multiple-choice-block").style.display = type === "multiple_choice" ? "block" : "none";
                card.querySelector(".short-text-block").style.display = type === "short_text" ? "block" : "none";
            }
            function getOptionLetter(index) {
                return String.fromCharCode(65 + index); // 0 -> A, 1 -> B, 2 -> C
            }
            function refreshOptionNames(card, qIndex) {
                const options = card.querySelectorAll(".option-item");

                options.forEach((opt, optIndex) => {
                    const label = opt.querySelector(".option-label");
                    if (label) {
                        label.innerText = getOptionLetter(optIndex) + ")";
                    }

                    opt.querySelectorAll(".option-text").forEach(input => {
                        const lang = input.dataset.lang;
                        input.name = `questions[${qIndex}][options][${optIndex}][${lang}]`;
                    });

                    const radio = opt.querySelector(".correct-option-radio");
                    radio.name = `questions[${qIndex}][correct_option]`;
                    radio.value = optIndex;
                });
            }

            function refreshNames(card, qIndex) {
                card.querySelector(".subject-select").name = `questions[${qIndex}][subject_id]`;
                card.querySelector(".type-select").name = `questions[${qIndex}][type]`;
                card.querySelectorAll(".q-title").forEach(input => input.name = `questions[${qIndex}][title][${input.dataset.lang}]`);
                card.querySelectorAll(".q-text").forEach(input => input.name = `questions[${qIndex}][text][${input.dataset.lang}]`);
                card.querySelector(".correct-answer").name = `questions[${qIndex}][correct_answer]`;
                refreshOptionNames(card, qIndex);
            }

            function addOption(card, qIndex) {
                const node = optionTemplate.content.cloneNode(true);
                card.querySelector(".options-wrapper").appendChild(node);

                const addedOption = card.querySelector(".options-wrapper .option-item:last-child");
                if (addedOption) {
                    addedOption.querySelectorAll('.ck-option-text').forEach(el => window.initEditor(el, 120));
                }

                refreshOptionNames(card, qIndex);
            }

            function reIndexAllQuestions() {
                const allCards = questionsWrapper.querySelectorAll(".question-item");
                allCards.forEach((card, index) => {
                    card.querySelector(".question-head").innerText = `Sual #${index + 1}`;
                    refreshNames(card, index);
                });
                questionIndex = allCards.length;
            }

            function addQuestion() {
                const node = questionTemplate.content.cloneNode(true);
                const card = node.querySelector(".question-item");
                questionsWrapper.appendChild(card);
                initQuestionEditors(card, questionIndex);

                // UNIQUE TAB IDS
                const uniqueId = "qtab_" + Date.now() + "_" + Math.floor(Math.random() * 1000);
                const langButtons = card.querySelectorAll(".question-lang-tab");
                const otherButton = card.querySelector(".question-other-tab");
                const langPanes = card.querySelectorAll(".question-lang-pane");
                const otherPane = card.querySelector(".question-other-pane");
                langButtons.forEach(btn => {
                    const lang = btn.dataset.lang;
                    const paneId = `${uniqueId}_lang_${lang}`;
                    btn.setAttribute("data-bs-target", `#${paneId}`);
                    card.querySelector(`.question-lang-pane[data-lang="${lang}"]`).id = paneId;
                });
                const otherPaneId = `${uniqueId}_other`;
                otherButton.setAttribute("data-bs-target", `#${otherPaneId}`);
                otherPane.id = otherPaneId;

                toggleBlocks(card);

                if (card.querySelector(".type-select").value === "multiple_choice") {
                    for (let i = 0; i < 4; i++) addOption(card, questionIndex);
                }

                refreshNames(card, questionIndex);

                card.querySelector(".type-select").addEventListener("change", function () {
                    toggleBlocks(card);
                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                    if (this.value === "multiple_choice" && card.querySelectorAll(".option-item").length === 0) {
                        for (let i = 0; i < 4; i++) addOption(card, qIndex);
                    }
                });

                card.querySelector(".add-option").addEventListener("click", function () {
                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                    addOption(card, qIndex);
                });

                card.querySelector(".remove-question").addEventListener("click", function () {
                    card.remove();
                    reIndexAllQuestions();
                });

                card.addEventListener("click", function (e) {
                    if (e.target.classList.contains("remove-option")) {
                        const optionItem = e.target.closest(".option-item");

                        optionItem.querySelectorAll('textarea').forEach(textarea => {
                            if (textarea.id && CKEDITOR.instances[textarea.id]) {
                                CKEDITOR.instances[textarea.id].destroy(true);
                            }
                        });

                        optionItem.remove();
                        reIndexAllQuestions();
                    }
                });

                questionIndex++;
                reIndexAllQuestions();
            }

            addQuestionBtn.addEventListener("click", addQuestion);
            addQuestion();
        });*/
    </script>
@endsection
