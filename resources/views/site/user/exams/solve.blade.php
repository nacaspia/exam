
@extends('site.user.layouts.app')
@section('site.user.css')
@endsection
@section('site.user.content')
    <div {{--class="main-content-wrapper"--}}>
        <div class="container-fluid">

            <!-- Student Top Start -->
            <div class="admin-top-bar students-top">
                <div class="courses-select">

                    <h4 class="title">{{ user()->name }} {{ user()->surname }}</h4>
                </div>
                @if(user()->type === 'parent')
                    <a href="{{ route('site.user.children.create',['locale' => app()->getLocale()]) }}" class="btn">{{ __('site.add_child') }} <i class="icofont-rounded-right"></i></a>
                @endif
            </div>
            <!-- Student Top End -->
<h3>{{ $exam->title[app()->getLocale()] }}</h3>

<div class="alert alert-info">
    ⏳ Qalan vaxt: <span id="timer"></span>
</div>

            <form method="POST" action="{{ route('site.user.exam.finish',['locale'=>app()->getLocale(),'exam'=>$exam->id]) }}">
                @csrf

                @foreach($questions as $index => $question)
                    <div class="card mb-3">
                        <div class="card-body">
                            <strong>{{ $index+1 }}. {{ $question->title[app()->getLocale()] ?? '' }}</strong>
                            <p>- {{ $question->text[app()->getLocale()] ?? ''}}</p>
                            @if($question['image'])
                                <img src="{{ asset('storage/'.$question['image']) }}">
                            @endif
                            {{-- Multiple Choice --}}
                            @if($question->type === 'multiple_choice')
                                @foreach($question->options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="answers[{{ $question->id }}]"
                                               value="{{ $option->id }}">
                                        <label class="form-check-label">
                                            {{ $option->option[app()->getLocale()] ?? 'No Option' }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Short Answer --}}
                            @if($question->type === 'short_text')
                                <div class="mb-3">
                                    <input type="text"
                                           class="form-control"
                                           name="answers[{{ $question->id }}]"
                                           placeholder="Cavabınızı yazın">
                                </div>
                            @endif
                            {{-- Short Answer --}}
                            @if($question->type === 'open_text')
                                <div class="mb-3">
                                    <input type="text"
                                           class="form-control"
                                           name="answers[{{ $question->id }}]"
                                           placeholder="Cavabınızı yazın">
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach

                <button class="btn btn-danger w-100">
                    İmtahanı bitir
                </button>
            </form>

</div>
</div>
</div>
@endsection
@section('site.user.js')
    <script>
        let seconds = {{ $exam->duration * 60 }};

        const timer = setInterval(() => {
            seconds--;
            let m = Math.floor(seconds / 60);
            let s = seconds % 60;
            document.getElementById('timer').innerText = m + ':' + s;

            if (seconds <= 0) {
                clearInterval(timer);
                document.querySelector('form').submit();
            }
        }, 1000);
    </script>

@endsection
