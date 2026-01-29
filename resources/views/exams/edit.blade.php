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
    <style>
        .input-group-text { cursor: pointer; }
        .input-group-text i { font-size: 1.2rem; }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.edit') }}</h2>
            <div class="btn-box">
                <a href="{{ route('exams.index') }}" class="btn btn-sm btn-primary">{{ __('content.exams') }}</a>
            </div>
        </div>

        @include('errors.messages')

        <div class="row">
            <div class="col-12">
                <form action="{{ route('exams.update', $exam['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel">
                        <div class="panel-body">

                            {{-- TAB NAV --}}
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                @foreach(languages() as $key => $lang)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if($key==0) active @endif" data-bs-toggle="tab"
                                           href="#{{$lang->code}}" role="tab">
                                            <span class="d-none d-sm-block">{{$lang->code}}</span>
                                        </a>
                                    </li>
                                @endforeach
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
                                @foreach(languages() as $key => $lang)
                                    <div class="tab-pane fade @if($key==0) show active @endif" id="{{$lang['code']}}" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">@lang('validation.attributes.title') - {{$lang['code']}}</label>
                                                <input type="text" class="form-control js-title"
                                                       name="title[{{$lang['code']}}]"
                                                       value="{{ old('title.'.$lang['code'], $exam['title'][$lang['code']] ?? '') }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Sual mətni ({{$lang['code']}})</label>
                                                <textarea class="form-control" name="text[{{$lang['code']}}]" rows="3">{{ old('text.'.$lang['code'], $exam['text'][$lang['code']] ?? '') }}</textarea>
                                            </div>
                                            {{-- SEO --}}
                                            <div class="col-12">
                                                <label class="form-label">Meta title ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-meta-title"
                                                       name="meta_title[{{$lang['code']}}]"
                                                       value="{{ old('meta_title.'.$lang['code'], $exam['seo']['meta_title'][$lang['code']] ?? '') }}"
                                                       placeholder="Boş burax → title-dan auto dolacaq">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Meta description ({{$lang['code']}})</label>
                                                <textarea class="form-control js-meta-text"
                                                          name="meta_text[{{$lang['code']}}]" rows="3"
                                                          placeholder="Boş burax → title-dan auto dolacaq">{{ old('meta_text.'.$lang['code'], $exam['seo']['meta_text'][$lang['code']] ?? '') }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Meta keywords ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-meta-keyword"
                                                       name="meta_keywords[{{$lang['code']}}]"
                                                       value="{{ old('meta_keywords.'.$lang['code'], $exam['seo']['meta_keywords'][$lang['code']] ?? '') }}"
                                                       placeholder="keyword1, keyword2">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">OG title ({{$lang['code']}})</label>
                                                <input type="text" class="form-control js-og-title"
                                                       name="og_title[{{$lang['code']}}]"
                                                       value="{{ old('og_title.'.$lang['code'], $exam['seo']['og_title'][$lang['code']] ?? '') }}"
                                                       placeholder="Boş burax → meta title-dan götürüləcək">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">OG description ({{$lang['code']}})</label>
                                                <textarea class="form-control js-og-text"
                                                          name="og_text[{{$lang['code']}}]" rows="2"
                                                          placeholder="Boş burax → meta description-dan götürüləcək">{{ old('og_text.'.$lang['code'], $exam['seo']['og_text'][$lang['code']] ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- QUESTIONS TAB --}}
                                <div class="tab-pane fade" id="questions" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5>İmtahan sualları</h5>
                                        <button type="button" class="btn btn-sm btn-success" id="addQuestionBtn">+ Sual əlavə et</button>
                                    </div>
                                    <div id="questionsWrapper">
                                        @foreach($exam['questions'] as $index => $question)
                                            @include('exams.question_edit', ['question' => $question, 'index' => $index])
                                        @endforeach
                                    </div>

                                    {{-- QUESTION & OPTION TEMPLATES --}}
                                    <template id="questionTemplate">@include('exams.question_template')</template>
                                    <template id="optionTemplate">@include('exams.option_template')</template>
                                </div>

                                {{-- OTHER TAB --}}
                                <div class="tab-pane" id="other" role="tabpanel">
                                    <div class="row g-3">

                                        {{-- CLASS --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Sinif</label>
                                            <select name="class_id" class="form-select" required>
                                                @foreach($schoolClasses as $class)
                                                    <option value="{{ $class['id'] }}"
                                                        @selected(old('class_id', $exam['class_id'] ?? null) == $class['id'])>
                                                        {{ $class['name'][language()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- LANGUAGE --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Exam Language</label>
                                            <select name="language" class="form-select" required>
                                                @foreach(languages() as $lang)
                                                    <option value="{{ $lang->code }}"
                                                        @selected(old('language', $exam['language'] ?? null) == $lang->code)>
                                                        {{ $lang->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- PRICE + DURATION GROUP --}}
                                        <div class="row g-3">

                                            {{-- PRICE TYPE --}}
                                            <div class="col-md-3">
                                                <label class="form-label">Qiymət növü (Pullu)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input price-type" type="radio"
                                                           name="price_type" value="paid" id="pricePaid"
                                                        @checked(old('price_type', ($exam['price_type'] ?? 'paid')) == 'paid')>
                                                    <label class="form-check-label" for="pricePaid">Pullu</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Qiymət növü (Pulsuz)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input price-type" type="radio"
                                                           name="price_type" value="free" id="priceFree"
                                                        @checked(old('price_type', ($exam['price_type'] ?? 'paid')) == 'free')>
                                                    <label class="form-check-label" for="priceFree">Pulsuz</label>
                                                </div>
                                            </div>

                                            {{-- PRICE --}}
                                            <div class="col-md-6">
                                                <label class="form-label">Qiymət</label>
                                                <input type="number" name="price" class="form-control price-input"
                                                       min="0" step="0.01"
                                                       value="{{ old('price', $exam['price'] ?? '') }}">
                                            </div>

                                            {{-- DURATION TYPE --}}
                                            <div class="col-md-3">
                                                <label class="form-label">Müddət növü (Müddətli)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input duration-type" type="radio"
                                                           name="duration_type" value="timed" id="durationTimed"
                                                        @checked(old('duration_type', ($exam['duration_type'] ?? 'timed')) == 'timed')>
                                                    <label class="form-check-label" for="durationTimed">Müddətli</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Müddət növü (Müddətsiz)</label>
                                                <div class="form-check">
                                                    <input class="form-check-input duration-type" type="radio"
                                                           name="duration_type" value="untimed" id="durationUntimed"
                                                        @checked(old('duration_type', ($exam['duration_type'] ?? 'timed')) == 'untimed')>
                                                    <label class="form-check-label" for="durationUntimed">Müddətsiz</label>
                                                </div>
                                            </div>

                                            {{-- DURATION --}}
                                            <div class="col-md-6 duration-field">
                                                <label class="form-label">Müddət (dəq)</label>
                                                <input type="number" name="duration" class="form-control" min="1"
                                                       value="{{ old('duration', $exam['duration'] ?? '') }}">
                                            </div>

                                            {{-- START TIME --}}
                                            <div class="col-md-6 start-time-field">
                                                <label class="form-label">Başlama vaxtı</label>
                                                <input type="text" name="start_time" class="form-control datetimepicker"
                                                       value="{{ old('start_time', $exam['start_time'] ?? '') }}">
                                            </div>

                                            {{-- END TIME --}}
                                            <div class="col-md-6 end-time-field">
                                                <label class="form-label">Bitmə vaxtı</label>
                                                <input type="text" name="end_time" class="form-control datetimepicker"
                                                       value="{{ old('end_time', $exam['end_time'] ?? '') }}">
                                            </div>

                                        </div>

                                        {{-- SHOW RESULT --}}
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="show_result" value="1"
                                                    @checked(old('show_result', $exam['show_result'] ?? 0) == 1)>
                                                <label class="form-check-label">Nəticəni göstər</label>
                                            </div>
                                        </div>

                                        {{-- ACTIVE + SEO SETTINGS --}}
                                        @if(cms_user()->hasPermission('exams-index'))

                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="active" value="1"
                                                        @checked(old('active', $exam['active'] ?? 0) == 1)>
                                                    <label class="form-check-label">Aktiv</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Canonical URL</label>
                                                <input type="text" class="form-control" name="canonical_url"
                                                       value="{{ old('canonical_url', $exam['canonical_url'] ?? '') }}"
                                                       placeholder="https://site.az/az/questions">
                                            </div>

                                            {{-- INDEX --}}
                                            <div class="col-12">
                                                <input type="hidden" name="index" value="0">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="index" value="1"
                                                        @checked(old('index', $exam['index'] ?? 0) == 1)>
                                                    <label class="form-check-label"> Index </label>
                                                </div>
                                            </div>

                                            {{-- FOLLOW --}}
                                            <div class="col-12">
                                                <input type="hidden" name="follow" value="0">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="follow" value="1"
                                                        @checked(old('follow', $exam['follow'] ?? 0) == 1)>
                                                    <label class="form-check-label"> Follow </label>
                                                </div>
                                            </div>

                                        @endif

                                        {{-- IMAGE --}}
                                        <div class="col-sm-12">
                                            <div class="col-lg-8 col-md-7">
                                                <div class="card component-jquery-uploader">
                                                    <div class="card-header">@lang('validation.attributes.image')</div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xxl-9 col-sm-8">

                                                                <label class="form-label">@lang('validation.attributes.image')</label>
                                                                <input type="file" name="image" id="mainImageUpload">

                                                                <p>Şəkilin maksimum ölçüsü 1228x1228 piksel olmalıdır.
                                                                    Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.</p>

                                                                {{-- OLD IMAGE PREVIEW --}}
                                                                <div id="mainImagePreview" style="margin-top: 10px;">
                                                                    @if(!empty($exam['image']))
                                                                        <img src="{{ asset('storage/' .$exam['image']) }}" style="max-width: 220px; border-radius: 8px;">
                                                                    @endif
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // ===== PRICE & DURATION TOGGLE =====
            const priceRadios = document.querySelectorAll(".price-type");
            const priceInput = document.querySelector(".price-input");
            const durationRadios = document.querySelectorAll(".duration-type");
            const durationField = document.querySelector(".duration-field");
            const startTimeField = document.querySelector(".start-time-field");
            const endTimeField = document.querySelector(".end-time-field");

            priceRadios.forEach(radio => {
                radio.addEventListener("change", function () {
                    priceInput.disabled = this.value !== "paid";
                    if(this.value !== "paid") priceInput.value = '';
                });
            });

            durationRadios.forEach(radio => {
                radio.addEventListener("change", function () {
                    if(this.value === "timed"){
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

            document.querySelector('input[name="price_type"]:checked')?.dispatchEvent(new Event('change'));
            document.querySelector('input[name="duration_type"]:checked')?.dispatchEvent(new Event('change'));


            // ===== QUESTIONS DYNAMIC =====
            let questionIndex = 0;
            const questionsWrapper = document.getElementById("questionsWrapper");
            const addQuestionBtn = document.getElementById("addQuestionBtn");
            const questionTemplate = document.getElementById("questionTemplate");
            const optionTemplate = document.getElementById("optionTemplate");

            function toggleBlocks(card){
                const type = card.querySelector(".type-select").value;
                card.querySelector(".multiple-choice-block").style.display = type === "multiple_choice" ? "block" : "none";
                card.querySelector(".short-text-block").style.display = type === "short_text" ? "block" : "none";
            }

            function refreshOptionNames(card, qIndex){
                card.querySelectorAll(".option-item").forEach((opt, optIndex)=>{
                    opt.querySelectorAll(".option-text").forEach(input=>{
                        const lang = input.dataset.lang;
                        input.name = `questions[${qIndex}][options][${optIndex}][${lang}]`;
                    });
                    const radio = opt.querySelector(".correct-option-radio");
                    radio.name = `questions[${qIndex}][correct_option]`;
                    radio.value = optIndex;
                });
            }

            function refreshNames(card, qIndex){
                card.querySelector(".subject-select").name = `questions[${qIndex}][subject_id]`;
                card.querySelector(".type-select").name = `questions[${qIndex}][type]`;
                card.querySelectorAll(".q-title").forEach(input=>input.name=`questions[${qIndex}][title][${input.dataset.lang}]`);
                card.querySelectorAll(".q-text").forEach(input=>input.name=`questions[${qIndex}][text][${input.dataset.lang}]`);
                card.querySelector(".correct-answer").name = `questions[${qIndex}][correct_answer]`;
                refreshOptionNames(card, qIndex);
            }

            function addOption(card, qIndex){
                const node = optionTemplate.content.cloneNode(true);
                card.querySelector(".options-wrapper").appendChild(node);
                refreshOptionNames(card, qIndex);
            }

            function reIndexAllQuestions(){
                questionsWrapper.querySelectorAll(".question-item").forEach((card, index)=>{
                    card.querySelector(".question-head").innerText = `Sual #${index+1}`;
                    refreshNames(card, index);
                });
                questionIndex = questionsWrapper.querySelectorAll(".question-item").length;
            }

            function addQuestion(existingData=null){
                const node = questionTemplate.content.cloneNode(true);
                const card = node.querySelector(".question-item");
                questionsWrapper.appendChild(card);

                const uniqueId = "qtab_" + Date.now() + "_" + Math.floor(Math.random()*1000);
                const langButtons = card.querySelectorAll(".question-lang-tab");
                const otherButton = card.querySelector(".question-other-tab");
                const langPanes = card.querySelectorAll(".question-lang-pane");
                const otherPane = card.querySelector(".question-other-pane");

                langButtons.forEach(btn=>{
                    const lang = btn.dataset.lang;
                    const paneId = `${uniqueId}_lang_${lang}`;
                    btn.setAttribute("data-bs-target", `#${paneId}`);
                    card.querySelector(`.question-lang-pane[data-lang="${lang}"]`).id = paneId;
                });

                const otherPaneId = `${uniqueId}_other`;
                otherButton.setAttribute("data-bs-target", `#${otherPaneId}`);
                otherPane.id = otherPaneId;

                toggleBlocks(card);

                if(card.querySelector(".type-select").value === "multiple_choice"){
                    for(let i=0;i<4;i++) addOption(card, questionIndex);
                }

                refreshNames(card, questionIndex);

                card.querySelector(".type-select").addEventListener("change", function(){
                    toggleBlocks(card);
                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                    if(this.value === "multiple_choice" && card.querySelectorAll(".option-item").length===0){
                        for(let i=0;i<4;i++) addOption(card, qIndex);
                    }
                });

                card.querySelector(".add-option").addEventListener("click", function(){
                    const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                    addOption(card, qIndex);
                });

                card.querySelector(".remove-question").addEventListener("click", function(){
                    card.remove();
                    reIndexAllQuestions();
                });

                card.addEventListener("click", function(e){
                    if(e.target.classList.contains("remove-option")){
                        e.target.closest(".option-item").remove();
                        reIndexAllQuestions();
                    }
                });

                questionIndex++;
                reIndexAllQuestions();
            }

            // LOAD EXISTING QUESTIONS
            document.querySelectorAll("#questionsWrapper .question-item").forEach(card=>{
                const qIndex = Array.from(questionsWrapper.querySelectorAll(".question-item")).indexOf(card);
                const typeSelect = card.querySelector(".type-select");
                toggleBlocks(card);
                typeSelect.addEventListener("change", function(){ toggleBlocks(card); });
            });

            addQuestionBtn.addEventListener("click", ()=>addQuestion());

        });
    </script>
@endsection
