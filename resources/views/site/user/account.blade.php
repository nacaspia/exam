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
            </div>
            @if(!empty($examResults[0]))
                <p class="title">Son imtahanlar</p>
            <!-- Student's Wrapper Start -->
            <div class="students-wrapper students-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($examResults as $exam)
                            <div class="swiper-slide">
                                <!-- Single Student Start -->
                                <div class="single-student">
                                    <div class="student-images">
                                        <img src="{{ !empty($exam->exam['image'])? asset('storage/'.$exam->exam->image) :asset('site/user/assets/images/author/admin.png') }}" alt="{{$exam->exam['title'][app()->getLocale()]}}">
                                    </div>
                                    <div class="student-content">
                                        <h5 class="name">{{$exam->exam['title'][app()->getLocale()]}}</h5>
                                        <p>{{ $exam->exam['text'][app()->getLocale()] }}</p>
                                        Bal: {{ $exam->total_score ?? 0 }} <br>
                                        Suallar: {{ $exam->exam->questions->count() }}  <br>
                                        Tarix: {{ $exam->created_at->format('d/m/Y H:i') }}  <br>
                                        Status: {{ ucfirst($exam->status) }} <br>
                                        <a href="{{ route('site.user.exam.result', ['locale' => app()->getLocale(), 'exam' => $exam->exam->id]) }}">{{ __('site.check_the_result') }}</a>
                                        <span class="date"><i class="icofont-ui-calendar"></i> {{ date('d.m.Y',strtotime($exam->exam['created_at'])) }}</span>
                                    </div>
                                </div>
                                <!-- Single Student End -->
                            </div>
                        @endforeach
                    </div>

                    <div class="students-arrow">
                        <!-- Add Pagination -->
                        <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div>
                        <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
            </div>
            @else
                <p class="title">Hələ imtahan nəticəniz yoxdur.</p>
            @endif



        </div>
    </div>
@endsection
@section('site.user.js')
@endsection
