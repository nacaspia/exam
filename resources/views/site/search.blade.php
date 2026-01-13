@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.search') }}
@endsection
@section('site.css')
    <link rel="stylesheet" href="{{ asset('site/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
@endsection
@section('site.content')
    <section class="course-grid-area pt-90 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="row mt-10">
                        @forelse($questions as $question)
                            <div class="col-lg-4 col-md-6 col-sm-8">
                                <div class="single-courses mt-30">
                                    <div class="courses-thumb">
                                        <img src="{{ $question->image? asset('storage/'.$question->image) : asset('site/assets/images/courses-grid-1.jpg') }}">
                                        {{-- <div class="courses-review">
                                             <span><i class="fas fa-star"></i>5.6</span>
                                         </div>--}}
                                        <div class="corses-thumb-title">
                                            <span>{{ $question->class->name[language()] ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="courses-content">
                                        <a {{--href="{{ route('site.examDetails',['locale' => app()->getLocale(), 'slug' => $question->slug[language()], 'id' => $question->id]) }}"--}}>
                                            <h4 class="title">{{ $question->title[language()] }}</h4>
                                        </a>
                                        <div class="courses-info d-flex justify-content-between">
                                            <div class="item">
                                                <p>{{ $question->subject->name[language()] ?? '' }}</p>
                                                @if($question->is_paid)
                                                    <span>{{ $question->price }} AZN</span>
                                                @else
                                                    <span>Pulsuz</span>
                                                @endif
                                            </div>
                                            @if(user())
                                                @php
                                                    $examResult = \App\Models\ExamResult::where('user_id', user()->id)
                                                        ->where('exam_id', $question->id)
                                                        ->first();
                                                @endphp

                                                @if($examResult && $examResult->status === 'finished')
                                                    <a href="{{ route('site.user.exam.result', ['locale' => app()->getLocale(),'exam'=>$question->id]) }}">
                                                        Nəticəyə bax
                                                    </a>
                                                @else
                                                    <a href="{{ route('site.user.exams.show',['locale' => app()->getLocale(),'exam'=> $question->id]) }}">
                                                        İmtahana başla
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('site.auth.login',['locale' => app()->getLocale()]) }}">
                                                    Daxil ol
                                                </a>
                                            @endif
                                        </div>
                                        {{--<ul>
                                            <li><i class="fal fa-users"></i> 23</li>
                                            <li><i class="fal fa-clock"></i> 10 Hr</li>
                                            <li><i class="fal fa-comments"></i> 143</li>
                                        </ul>--}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Nəticə tapılmadı</p>
                        @endforelse
                        <div class="col-lg-12">
                            <div class="pagination-item d-flex justify-content-center mt-50">
                                @if ($questions->hasPages())
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            {{-- Previous --}}
                                            <li class="page-item {{ $questions->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $questions->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">
                                                        <i class="fal fa-arrow-left"></i>
                                                    </span>
                                                </a>
                                            </li>

                                            {{-- Pages --}}
                                            @foreach ($questions->links()->elements[0] as $page => $url)
                                                <li class="page-item {{ $page == $questions->currentPage() ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $url }}">
                                                        {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                </li>
                                            @endforeach

                                            {{-- Next --}}
                                            <li class="page-item {{ $questions->hasMorePages() ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $questions->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">
                                                        <i class="fal fa-arrow-right"></i>
                                                    </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('site.js')
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/ajax-contact.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
@endsection
