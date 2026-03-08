@extends('site.user.layouts.app')

@section('site.user.css')
    <style>
        .exam-result-card .question-title {
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 14px;
        }

        .exam-answer-block {
            margin-top: 14px;
        }

        .exam-answer-line {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .exam-option-letter {
            display: inline-block;
            min-width: 32px;
            font-weight: 700;
        }

        .exam-option-text {
            display: inline-block;
            vertical-align: top;
        }

        .exam-correct-answer-box {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .exam-question-text {
            margin-top: 12px;
        }

        .exam-question-text img,
        .exam-option-text img,
        .exam-correct-answer-box img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@php
    function getOptionLetter($index) {
        return chr(65 + $index);
    }

    function findSelectedOptionData($options, $optionId) {
        foreach (($options ?? []) as $index => $opt) {
            $optId = is_array($opt) ? ($opt['id'] ?? null) : ($opt->id ?? null);

            if ($optId == $optionId) {
                return [
                    'letter' => getOptionLetter($index),
                    'option' => $opt,
                ];
            }
        }

        return null;
    }

    function findCorrectOptionData($options) {
        foreach (($options ?? []) as $index => $opt) {
            $isCorrect = is_array($opt) ? ($opt['is_correct'] ?? 0) : ($opt->is_correct ?? 0);

            if ((int)$isCorrect === 1) {
                return [
                    'letter' => getOptionLetter($index),
                    'option' => $opt,
                ];
            }
        }

        return null;
    }

    function getLocalizedOptionText($option, $locale) {
        if (!$option) {
            return '';
        }

        $optionText = is_array($option) ? ($option['option'] ?? []) : ($option->option ?? []);
        return $optionText[$locale] ?? '';
    }
@endphp

@section('site.user.content')
    <div class="container mt-3 exam-result-card">
        <h2>{{ __('site.result') }}: {{ $exam->title[app()->getLocale()] ?? '' }}</h2>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>{{ __('site.total_score') }}:</strong> {{ $result->total_score }}</p>
                <p>
                    <strong>{{ __('site.total_score') }} % :</strong>
                    {{ count($result->studentAnswers) > 0 ? round(($result->total_score / count($result->studentAnswers)) * 100, 2) : 0 }}%
                </p>
                <p><strong>{{ __('site.time') }}:</strong> {{ $result->time_spent }} {{ __('site.seconds') }}</p>

                @if($exam->show_result)
                    <p class="text-success mb-0">{{ __('site.result_is_available') }}</p>
                @else
                    <p class="text-warning mb-0">{{ __('site.result_will_be_checked') }}</p>
                @endif
            </div>
        </div>

        <h4>{{ __('site.questions_and_answers') }}</h4>

        @foreach($result->studentAnswers as $answer)
            @php
                $locale = app()->getLocale();
                $question = $answer->question;
                $options = $question->options ?? [];
                $selectedData = $question->type === 'multiple_choice'
                    ? findSelectedOptionData($options, $answer->question_option_id)
                    : null;
                $correctData = $question->type === 'multiple_choice'
                    ? findCorrectOptionData($options)
                    : null;
            @endphp

            <div class="card mb-3">
                <div class="card-body">
                    <div class="question-title">
                        {{ $loop->iteration }}. {{ $question->title[$locale] ?? 'No Title' }}
                    </div>

                    @if(!empty($question->text[$locale]))
                        <div class="exam-question-text">
                            {!! $question->text[$locale] !!}
                        </div>
                    @endif

                    <div class="exam-answer-block">
                        <div class="exam-answer-line">
                            <strong>{{ __('site.your_answer') }}:</strong>

                            @if($question->type === 'multiple_choice')
                                @if($selectedData)
                                    <span class="exam-option-letter">{{ $selectedData['letter'] }})</span>
                                    <span class="exam-option-text">
                                        {!! getLocalizedOptionText($selectedData['option'], $locale) !!}
                                    </span>
                                @else
                                    <span>-</span>
                                @endif
                            @else
                                {!! $answer->answer_text ?? '-' !!}
                            @endif
                        </div>

                        @if($answer->is_correct)
                            <div class="exam-answer-line text-success">
                                ✅ {{ __('site.true') }}
                            </div>
                        @else
                            <div class="exam-answer-line text-danger">
                                ❌ {{ __('site.false') }}
                            </div>

                            <div class="exam-correct-answer-box">
                                <strong>{{ __('site.correct_answer') }}:</strong>

                                @if($question->type === 'multiple_choice')
                                    @if($correctData)
                                        <div class="mt-2">
                                            <span class="exam-option-letter">{{ $correctData['letter'] }})</span>
                                            <span class="exam-option-text">
                                                {!! getLocalizedOptionText($correctData['option'], $locale) !!}
                                            </span>
                                        </div>
                                    @else
                                        <div class="mt-2">-</div>
                                    @endif
                                @else
                                    <div class="mt-2">
                                        {!! $question->answer->answer ?? '-' !!}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('site.user.js')
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['\\(', '\\)'], ['$', '$']],
                displayMath: [['\\[', '\\]'], ['$$', '$$']]
            },
            svg: {
                fontCache: 'global'
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js"></script>
@endsection
