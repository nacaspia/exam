@extends('site.user.layouts.app')
@section('site.user.css')
@endsection
@section('site.user.content')
    <div class="main-content-wrapper">
        <div class="container-fluid">

            <!-- Student Top Start -->
            <div class="admin-top-bar students-top">
                <div class="courses-select">
                    <select>
                        <option value="">{{ __('site.all_class') }}</option>
                        @if(!empty($classes[0]))
                            @foreach($classes as $class)
                                <option value="{{ $class['id'] }}">{{$class['name'][language()]}}</option>
                            @endforeach
                        @endif
                    </select>

                    <h4 class="title">{{ user()->name }} {{ user()->surname }}</h4>
                </div>
                @if(user()->type === 'parent')
                    <a href="{{ route('site.user.children.create',['locale' => app()->getLocale()]) }}" class="btn">{{ __('site.add_child') }} <i class="icofont-rounded-right"></i></a>
                @endif
            </div>
            <!-- Student Top End -->

            @if(user()->type === 'parent')
            <!-- Student's Wrapper Start -->
            <div class="students-wrapper students-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($children as $child)
                            <div class="swiper-slide">
                                <!-- Single Student Start -->
                                <div class="single-student">
                                    <div class="student-images">
                                        <img src="{{ asset('site/user/assets/images/author/admin.png') }}" alt="{{$child['name']}}">
                                    </div>
                                    <div class="student-content">
                                        <h5 class="name">{{$child['name']}} {{$child['surname']}}</h5>
                                        <p>{{ $child['class']['name'][language()] }}</p>
                                        <span class="date"><i class="icofont-ui-calendar"></i> {{ date('d.m.Y',strtotime($child['created_at'])) }}</span>
                                         <a href="{{ route('site.user.children.edit',['locale' => app()->getLocale(),'id' => (int)$child['id']]) }}"><i class="icofont-ui-edit"></i> {{ __('site.edit') }}</a>
                                         <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $child['id'] }}"><i class="icofont-ui-delete"></i> {{ __('site.delete') }}</a>
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
                @foreach($children  as $delete)
                    <div class="modal fade" id="deleteModal-{{ $delete['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $delete['id'] }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $delete['id'] }}">{{ __('content.delete') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('content.are_you_delete') }} <strong>{{ $delete['name'] }} {{ $delete['surname'] }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.cancel') }}</button>

                                    <form action="{{ route('site.user.children.delete',['locale' => app()->getLocale(),'id' => (int)$delete['id']]) }}" method="POST" class="delete-role-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('content.delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            <!-- Student's Wrapper End -->
            @endif


        </div>
    </div>
@endsection
@section('site.user.js')
@endsection
