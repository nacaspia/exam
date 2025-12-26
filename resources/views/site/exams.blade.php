@extends('site.layouts.app')
@section('site.meta')

@endsection
@section('site.title')
    {{ __('site.exams') }}
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
                    <div class="course-grid mt-30">
                        <div class="course-grid-top d-sm-flex d-block justify-content-between align-items-center">
                            <form method="GET" action="">
                            <div class="course-filter d-block align-items-center d-sm-flex">
                                <select name="class_id" onchange="this.form.submit()">
                                    <option value="" @if(empty($_GET['class_id']))  selected @endif >{{ __('site.classes') }}</option>
                                    @if(!empty($classes))
                                        @foreach($classes as $class)
                                            <option value="{{$class['id']}}" @if(!empty($_GET['class_id']) && $_GET['class_id']==$class['id'])  selected @endif>{{$class['name'][language()]}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select name="subject_id" onchange="this.form.submit()">
                                    <option value="" @if(empty($_GET['subject_id']))  selected @endif>{{ __('site.subjects') }}</option>
                                    @if(!empty($subjects))
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject['id']}}" @if(!empty($_GET['subject_id']) && $_GET['subject_id']==$subject['id'])  selected @endif>{{$subject['name'][language()]}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-10 justify-content-center">
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
                                            </div>
                                            @if($question->is_paid)
                                                <span>{{ $question->price }} ₼</span>
                                            @else
                                                <span>Pulsuz</span>
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
