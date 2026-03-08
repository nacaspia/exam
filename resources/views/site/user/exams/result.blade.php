@extends('site.user.layouts.app')

@section('site.user.css')
@endsection

@php
    function optionLetterByOptions($options, $optionId) {
        foreach (($options ?? []) as $index => $opt) {
            $optId = is_array($opt) ? ($opt['id'] ?? null) : ($opt->id ?? null);

            if ($optId == $optionId) {
                return chr(65 + $index);
            }
        }
        return null;
    }

    function correctOptionData($options) {
        foreach (($options ?? []) as $index => $opt) {

            $isCorrect = is_array($opt) ? ($opt['is_correct'] ?? 0) : ($opt->is_correct ?? 0);
            if ($isCorrect == 1) {
                return [
                    'letter' => chr(65 + $index),
                    'option' => $opt['option'],
                ];
            }
        }

        return null;
    }

    function optionTextByLocale($option, $locale) {
        if (!$option) return '';

        $optionText = is_array($option) ? ($option['option'] ?? []) : ($option->option ?? []);

        return $optionText[$locale] ?? '';
    }
@endphp

@section('site.user.content')
    <div class="container mt-3">
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
                    <p class="text-success">{{ __('site.result_is_available') }}</p>
                @else
                    <p class="text-warning">{{ __('site.result_will_be_checked') }}</p>
                @endif
            </div>
        </div>

        <h4>{{ __('site.questions_and_answers') }}</h4>

        @foreach($result->studentAnswers as $answer)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>
                        {{ $loop->iteration }}.
                        {{ $answer->question->title[app()->getLocale()] ?? 'No Title' }}
                    </strong>

                    <p>
                        {{ __('site.your_answer') }}:

                        @if($answer->question->type === 'multiple_choice')
                            @php
                                $selectedLetter = optionLetterByOptions($answer->question->options ?? [], $answer->question_option_id);
                            @endphp

                            @if($selectedLetter)
                                <strong>{{ $selectedLetter }})</strong>
                            @endif
{{--                        @dd($answer)--}}
                            {!! optionTextByLocale($answer->questionOption, app()->getLocale()) !!}
                        @else
                            {!! $answer->answer_text ?? '' !!}
                        @endif
                    </p>

                    @if($answer->is_correct)
                        <p class="text-success">✅ {{ __('site.true') }}</p>
                    @else
                        <p class="text-danger">❌ {{ __('site.false') }}</p>

                        <p>
                            {{ __('site.correct_answer') }}:

                            @if($answer->question->type === 'multiple_choice')
                                @php
                                    $correctData = correctOptionData($answer->question->options ?? []);
                                @endphp

                                @if($correctData)
                                    <strong>{{ $correctData['letter'] }})</strong>
                                    {!! optionTextByLocale($correctData, app()->getLocale()) !!}
                                @endif
                            @else
                                {!! $answer->question->answer->answer ?? '' !!}
                            @endif
                        </p>
                    @endif
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
