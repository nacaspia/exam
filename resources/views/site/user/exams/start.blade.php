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

            <h3></h3>
            <div class="alert alert-info">
                {{ $exam->title[app()->getLocale()] }}
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <p><strong>Qiymət:</strong> {{ $exam->price }} AZN</p>
                    <p><strong>Müddət:</strong> {{ $exam->duration }} dəqiqə</p>
                    <p><strong>Sual sayı:</strong> {{ $exam->question_count }} sual</p>

                    {{-- PAYMENT --}}
                    <form action="{{ route('site.user.exam.pay', [app()->getLocale(), $exam->id]) }}" method="POST">
                        @csrf
                        <button class="btn btn-success w-100">
                            Ödəniş et və imtahana başla
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div
@endsection
@section('site.user.js')
@endsection
