{{--@dd($question)--}}
<div class="card mb-3 question-item">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong class="question-head">Sual #{{ $index + 1 }}</strong>
        <button type="button" class="btn btn-sm btn-danger remove-question">Sil</button>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3 question-tabs" role="tablist">
            @foreach(languages() as $k => $lang)
                @if($lang->code === 'az')
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($k==0) active @endif question-lang-tab"
                            type="button" data-bs-toggle="tab"
                            data-lang="{{ $lang->code }}"
                            data-bs-target="#q{{ $question['id'] }}_lang_{{ $lang->code }}">
                        {{ strtoupper($lang->code) }}
                    </button>
                </li>
                @endif
            @endforeach
            <li class="nav-item" role="presentation">
                <button class="nav-link question-other-tab" type="button"
                        data-bs-toggle="tab"
                        data-bs-target="#q{{ $question['id'] }}_other">
                    Digər
                </button>
            </li>
        </ul>

        <div class="tab-content question-tab-content">
            @foreach(languages() as $k => $lang)
                @if($lang->code === 'az')
                <div class="tab-pane fade @if($k==0) show active @endif question-lang-pane"
                     id="q{{ $question['id'] }}_lang_{{ $lang->code }}"
                     data-lang="{{ $lang->code }}" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Sual Başlıq ({{ $lang->code }})</label>
                            <input type="text" class="form-control q-title"
                                   data-lang="{{ $lang->code }}"
                                   name="questions[{{ $index }}][title][{{ $lang->code }}]"
                                   value="{{ $question['title'][$lang->code] ?? '' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Sual haqqda Mətn ({{ $lang->code }})</label>
                            <textarea class="ckeditor4 form-control q-text" rows="4"
                                      data-lang="{{ $lang->code }}"
                                      name="questions[{{ $index }}][text][{{ $lang->code }}]">{!! $question['text'][$lang->code] ?? '' !!}</textarea>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach

            {{-- OTHER --}}
            <div class="tab-pane fade question-other-pane" id="q{{ $question['id'] }}_other" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fənn</label>
                        <select class="form-select subject-select" name="questions[{{ $index }}][subject_id]">
                            <option value="">Seçin</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject['id'] }}"
                                        @if($question['subject_id'] == $subject['id']) selected @endif>
                                    {{ $subject['name'][language()] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sual növü</label>
                        <select class="form-select type-select" name="questions[{{ $index }}][type]">
                            <option value="">Seçin</option>
                            <option value="multiple_choice" @if($question['type'] === 'multiple_choice') selected @endif>Variantlı</option>
                            <option value="short_text" @if($question['type'] === 'short_text') selected @endif>Açıq sual</option>
                        </select>
                    </div>

                    {{-- MULTIPLE CHOICE --}}
                    <div class="col-12 multiple-choice-block" style="display: {{ $question['type'] === 'multiple_choice' ? 'block' : 'none' }}">
                        <hr>
                        <h6>Variantlar</h6>
                        <div class="options-wrapper">
                          {{--  @if($question['type'] === 'multiple_choice')
                                @foreach($question['options'] as $optIndex => $opt)
                                    <div class="row g-2 align-items-center option-item mb-2">
                                        @foreach(languages() as $lang)
                                            @if($lang->code === 'az')
                                            <div class="col-md-3">
                                                <input type="text" class="form-control option-text"
                                                       data-lang="{{ $lang->code }}"
                                                       name="questions[{{ $index }}][options][{{ $optIndex }}][{{ $lang->code }}]"
                                                       value="{{ $opt['option'][$lang->code] ?? '' }}"
                                                       placeholder="Variant ({{ $lang->code }})">
                                            </div>
                                            @endif
                                        @endforeach
                                        <div class="col-md-1 text-center">
                                            <input type="radio" class="form-check-input correct-option-radio"
                                                   name="questions[{{ $index }}][correct_option]"
                                                   value="{{ $optIndex }}" @if($opt['is_correct']) checked @endif>
                                            Düzgün cavab
                                        </div>
                                        <div class="col-md-1 text-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-option">Sil</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif--}}
                            @if($question['type'] === 'multiple_choice')
                                @foreach($question['options'] as $optIndex => $opt)
                                    <div class="row g-2 align-items-start option-item mb-3">
                                        <div class="col-md-1">
                                            <label class="form-label fw-bold option-label">
                                                {{ chr(65 + $optIndex) }})
                                            </label>
                                        </div>

                                        @foreach(languages() as $lang)
                                            @if($lang->code === 'az')
                                                <div class="col-md-7">
                                                    <textarea class="ckeditor4  form-control option-text math-input"
                                                              data-lang="{{ $lang->code }}"
                                                              name="questions[{{ $index }}][options][{{ $optIndex }}][{{ $lang->code }}]"
                                                              rows="3"
                                                              placeholder="Cavabı qeyd edin">{{ trim(strip_tags($opt['option'][$lang->code] ?? '')) }}</textarea>

{{--                                                    <div class="math-preview mt-2 p-2 border rounded bg-light"></div>--}}
                                                </div>
                                            @endif
                                        @endforeach

                                        <div class="col-md-3">
                                            <div class="form-check" style="margin-top:10px;">
                                                <input type="radio" class="form-check-input correct-option-radio"
                                                       name="questions[{{ $index }}][correct_option]"
                                                       value="{{ $optIndex }}" @if($opt['is_correct']) checked @endif>
                                                <label class="form-check-label">Düzgün cavab</label>
                                            </div>
                                        </div>

                                        <div class="col-md-1 text-end">
                                            <button type="button" class="btn btn-sm btn-danger remove-option" style="margin-top:5px;">
                                                Sil
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success add-option">+ Variant əlavə et</button>
                    </div>

                    {{-- SHORT TEXT --}}
                    <div class="col-12 short-text-block" style="display: {{ $question['type'] === 'short_text' ? 'block' : 'none' }}">
                        <label class="form-label">Doğru cavab</label>
                        <textarea class="form-control correct-answer ck-question-correct-answer"
                                  name="questions[{{ $index }}][correct_answer]"
                                  rows="3">{!! $question['short_answer']['correct_answer'] ?? '' !!}</textarea>
                        {{--<input type="text" class="form-control correct-answer"
                               name="questions[{{ $index }}][correct_answer]"
                               value="{{ $question['short_answer']['correct_answer'] ?? ''}}">--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
