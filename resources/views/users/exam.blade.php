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
@endsection
@section('content')
    <!-- main content start -->
    <div class="main-content">
        <div class="dashboard-breadcrumb mb-25">
            <h2>{{ __('content.show') }}</h2>
            <div class="btn-box">
                <a href="{{ route('cms-users.index') }}" class="btn btn-sm btn-primary"> {{ __('content.cms_users') }}</a>
            </div>
        </div>
        @include('errors.messages')
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <h2>{{ __('site.result') }}: {{ $exam['title'][language()] }}</h2>

                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>{{ __('site.total_score') }}:</strong> {{ $examResult['total_score'] }}</p>
                                <p><strong>{{ __('site.total_score') }} % :</strong> {{ count($examResult['student_answers']) > 0 ? round(($examResult['total_score'] / count($examResult['student_answers'])) * 100, 2) : 0 }}%</p>
                                <p><strong>{{ __('site.time') }}:</strong> {{ $examResult['time_spent'] }} {{ __('site.seconds') }}</p>

                                @if($exam['show_result'])
                                    <p class="text-success">{{ __('site.result_is_available') }}</p>
                                @else
                                    <p class="text-warning">{{ __('site.result_will_be_checked') }}</p>
                                @endif
                            </div>
                        </div>

                        <h4>{{ __('site.questions_and_answers') }}</h4>

                        @foreach($examResult['student_answers'] as $answer)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <strong>{{ $loop->iteration }}. {{ $answer['question']['title'][language()] ?? 'No Title' }}</strong>

                                    <p>
                                        {{ __('site.your_answer') }}:
                                        @if($answer['question_option_id'])
                                            {{ $answer['question_option']['option'][language()] ?? '' }}
                                        @else
                                            {{ $answer['answer_text'] ?? '' }}
                                        @endif
                                    </p>

                                    @if($answer['is_correct'])
                                        <p class="text-success">✅ {{ __('site.true') }}</p>
                                    @else
                                        <p class="text-danger">❌ {{ __('site.false') }}</p>
                                        <p>{{ __('site.correct_answer') }}:
                                            @if($answer['question']['type'] === 'multiple_choice')
                                                {{
                                                    collect($answer['question']['options'])
                                                        ->where('is_correct', 1)
                                                        ->first()['option'][language()] ?? ''
                                                }}
                                            @else
                                                {{ $answer['question']['answer']['answer'] ?? '' }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
@endsection
