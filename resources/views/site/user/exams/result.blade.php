@extends('site.user.layouts.app')
@section('site.user.css')
@endsection
@section('site.user.content')
    <div class="container mt-3">
        <h2>{{ __('site.result') }}: {{ $exam->title[app()->getLocale()] }}</h2>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>{{ __('site.total_score') }}:</strong> {{ $result->total_score }}</p>
                <p><strong>{{ __('site.time') }}:</strong> {{ $result->time_spent }} {{ __('site.seconds') }}</p>

                @if($exam->show_result)
                    <p class="text-success">{{ __('site.“result_is_available') }}</p>
                @else
                    <p class="text-warning">{{ __('site.result_will_be_checked') }}</p>
                @endif
            </div>
        </div>

        <h4>{{ __('site.questions_and_answers') }}</h4>

        @foreach($result->studentAnswers as $answer)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $loop->iteration }}. {{ $answer->question->title[app()->getLocale()] ?? 'No Title' }}</strong>

                    <p>
                        {{ __('site.your_answer') }}:
                        @if($answer->question_option_id)
                            {{ $answer->questionOption->option[app()->getLocale()] ?? '' }}
                        @else
                            {{ $answer->answer_text ?? '' }}
                        @endif
                    </p>

                    @if($answer->is_correct)
                        <p class="text-success">✅ {{ __('site.true') }}</p>
                    @else
                        <p class="text-danger">❌ {{ __('site.false') }}</p>
                        <p>{{ __('site.correct_answer') }}:
                            @if($answer->question->type === 'multiple_choice')
                                {{ $answer->question->options->where('is_correct', 1)->first()->option[app()->getLocale()] ?? '' }}
                            @else
                                {{ $answer->question->answer->answer ?? '' }}
                            @endif
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
@section('site.user.js')
@endsection
