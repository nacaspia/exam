@extends('layouts.app')
@section('title')
    {{ __('content.show') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" id="primaryColor" href="{{ asset('assets/css/blue-color.css') }}">

    <style>
        .result-question-title {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .result-question-text {
            margin: 10px 0 14px;
        }

        .result-answer-line {
            margin-bottom: 10px;
        }

        .result-option-letter {
            display: inline-block;
            min-width: 30px;
            font-weight: 700;
        }

        .result-option-text {
            display: inline-block;
            vertical-align: top;
        }

        .result-correct-box {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .result-question-text img,
        .result-option-text img,
        .result-correct-box img {
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
            if (($opt['id'] ?? null) == $optionId) {
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
            if ((int) ($opt['is_correct'] ?? 0) === 1) {
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

        $optionText = $option['option'] ?? [];
        return $optionText[$locale] ?? '';
    }
@endphp

@section('content')
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.show') }}</h2>
            <div class="btn-box">
                <a href="{{ route('cms-users.index') }}" class="btn btn-sm btn-primary">
                    {{ __('content.cms_users') }}
                </a>
            </div>
        </div>

        @include('errors.messages')
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <h2>{{ __('site.result') }}: {{ $exam['title'][language()] ?? '' }}</h2>

                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>{{ __('site.total_score') }}:</strong> {{ $examResult['total_score'] }}</p>
                                <p>
                                    <strong>{{ __('site.total_score') }} % :</strong>
                                    {{ count($examResult['student_answers'] ?? []) > 0 ? round(($examResult['total_score'] / count($examResult['student_answers'])) * 100, 2) : 0 }}%
                                </p>
                                <p><strong>{{ __('site.time') }}:</strong> {{ $examResult['time_spent'] }} {{ __('site.seconds') }}</p>

                                @if($exam['show_result'])
                                    <p class="text-success mb-0">{{ __('site.result_is_available') }}</p>
                                @else
                                    <p class="text-warning mb-0">{{ __('site.result_will_be_checked') }}</p>
                                @endif
                            </div>
                        </div>

                        <h4>{{ __('site.questions_and_answers') }}</h4>

                        @foreach($examResult['student_answers'] as $answer)
                            @php
                                $locale = language();
                                $question = $answer['question'] ?? [];
                                $options = $question['options'] ?? [];
                                $selectedData = (($question['type'] ?? null) === 'multiple_choice')
                                    ? findSelectedOptionData($options, $answer['question_option_id'] ?? null)
                                    : null;
                                $correctData = (($question['type'] ?? null) === 'multiple_choice')
                                    ? findCorrectOptionData($options)
                                    : null;
                            @endphp

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="result-question-title">
                                        {{ $loop->iteration }}. {{ $question['title'][$locale] ?? 'No Title' }}
                                    </div>

                                    @if(!empty($question['text'][$locale]))
                                        <div class="result-question-text">
                                            {!! $question['text'][$locale] !!}
                                        </div>
                                    @endif

                                    <div class="result-answer-line">
                                        <strong>{{ __('site.your_answer') }}:</strong>

                                        @if(($question['type'] ?? null) === 'multiple_choice')
                                            @if($selectedData)
                                                <span class="result-option-letter">{{ $selectedData['letter'] }})</span>
                                                <span class="result-option-text">
                                                    {!! getLocalizedOptionText($selectedData['option'], $locale) !!}
                                                </span>
                                            @else
                                                <span>-</span>
                                            @endif
                                        @else
                                            {!! $answer['answer_text'] ?? '-' !!}
                                        @endif
                                    </div>

                                    @if($answer['is_correct'])
                                        <div class="result-answer-line text-success">
                                            ✅ {{ __('site.true') }}
                                        </div>
                                    @else
                                        <div class="result-answer-line text-danger">
                                            ❌ {{ __('site.false') }}
                                        </div>

                                        <div class="result-correct-box">
                                            <strong>{{ __('site.correct_answer') }}:</strong>

                                            @if(($question['type'] ?? null) === 'multiple_choice')
                                                @if($correctData)
                                                    <div class="mt-2">
                                                        <span class="result-option-letter">{{ $correctData['letter'] }})</span>
                                                        <span class="result-option-text">
                                                            {!! getLocalizedOptionText($correctData['option'], $locale) !!}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="mt-2">-</div>
                                                @endif
                                            @else
                                                <div class="mt-2">
                                                    {!! $question['answer']['answer'] ?? '-' !!}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
