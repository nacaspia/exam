<div class="card mb-3 question-item">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong class="question-head">Sual</strong>
        <button type="button" class="btn btn-sm btn-danger remove-question">Sil</button>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3 question-tabs" role="tablist">
            @foreach(languages() as $k => $lang)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($k==0) active @endif question-lang-tab"
                            type="button" data-bs-toggle="tab"
                            data-lang="{{ $lang->code }}"
                            data-bs-target="#"> {{ strtoupper($lang->code) }} </button>
                </li>
            @endforeach
            <li class="nav-item" role="presentation">
                <button class="nav-link question-other-tab" type="button" data-bs-toggle="tab" data-bs-target="#"> Digər
                </button>
            </li>
        </ul>

        <div class="tab-content question-tab-content">
            @foreach(languages() as $k => $lang)
                <div class="tab-pane fade @if($k==0) show active @endif question-lang-pane"
                     data-lang="{{ $lang->code }}" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Başlıq ({{ $lang->code }})</label>
                            <input type="text" class="form-control q-title" data-lang="{{ $lang->code }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mətn ({{ $lang->code }})</label>
                            <textarea class="form-control q-text" rows="4" data-lang="{{ $lang->code }}"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- OTHER --}}
            <div class="tab-pane fade question-other-pane" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Fənn</label>
                        <select class="form-select subject-select">
                            <option value="">Seçin</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject['id'] }}">{{ $subject['name'][language()] }}</option>
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

                    <div class="col-12 multiple-choice-block" style="display:none">
                        <hr>
                        <h6>Variantlar</h6>
                        <div class="options-wrapper"></div>
                        <button type="button" class="btn btn-sm btn-outline-success add-option">+ Variant əlavə et</button>
                    </div>

                    <div class="col-12 short-text-block" style="display:none">
                        <label class="form-label">Doğru cavab</label>
                        <input type="text" class="form-control correct-answer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
