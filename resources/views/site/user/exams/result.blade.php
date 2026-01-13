@extends('site.user.layouts.app')
@section('site.user.css')
@endsection
@section('site.user.content')
    <div class="container mt-3">
        <h2>Nəticə: {{ $exam->title[app()->getLocale()] }}</h2>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Toplam bal:</strong> {{ $result->total_score }}</p>
                <p><strong>Vaxt:</strong> {{ $result->time_spent }} saniyə</p>

                @if($exam->show_result)
                    <p class="text-success">Nəticə açıqdır</p>
                @else
                    <p class="text-warning">Nəticə müəllim tərəfindən yoxlanılacaq</p>
                @endif
            </div>
        </div>

        <h4>Suallar və cavablar</h4>

        @foreach($result->studentAnswers as $answer)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $loop->iteration }}. {{ $answer->question->title[app()->getLocale()] ?? 'No Title' }}</strong>

                    <p>
                        Cavabınız:
                        @if($answer->question_option_id)
                            {{ $answer->questionOption->option[app()->getLocale()] ?? '' }}
                        @else
                            {{ $answer->answer_text ?? '' }}
                        @endif
                    </p>

                    @if($answer->is_correct)
                        <p class="text-success">✅ Düzgün</p>
                    @else
                        <p class="text-danger">❌ Səhv</p>
                        <p>Düzgün cavab:
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
