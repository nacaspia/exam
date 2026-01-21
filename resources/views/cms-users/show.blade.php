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
                        <div class="row g-3">
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.username') }}</label>
                                <input type="text" class="form-control form-control-sm" name="username" value="{{ $cmsUser['username'] ?? old('username') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.name') }}</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{ $cmsUser['name'] ?? old('name') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.surname') }}</label>
                                <input type="text" class="form-control form-control-sm" name="surname" value="{{ $cmsUser['surname'] ?? old('surname') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.email') }}</label>
                                <input type="email" class="form-control form-control-sm" name="email" value="{{ $cmsUser['email'] ?? old('email') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.phone') }}</label>
                                <input type="tel" class="form-control form-control-sm" name="phone" value="{{ $cmsUser['phone'] ?? old('phone') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.pin') }}</label>
                                <input type="text" class="form-control form-control-sm" name="pin" value="{{ $cmsUser['pin'] ?? old('pin') }}" readonly>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.birthday') }}</label>
                                <input type="text" class="form-control form-control-sm" name="birthday" value="{{ $cmsUser['birthday'] ?? old('birthday') }}" placeholder="Y-m-d" readonly>
                            </div>
                            {{--<div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.password') }}</label>
                                <input type="password" class="form-control form-control-sm" name="password">
                            </div>--}}
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <label class="form-label">{{ __('validation.attributes.role') }}</label>
                                <select class="form-control form-control-sm" data-placeholder="{{ __('content.choose') }}" name="roles" disabled>
                                    <option value="">{{ __('content.choose') }}</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role['id'] }}" @if($role['id'] == ($cmsUser['roles'][0]['id'] ?? old('roles'))) selected @endif>{{ $role['name'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="panel">
                    <div class="panel-header">
                        <h5>{{ __('content.questions') }}</h5>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped" id="allEmployeeTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('validation.attributes.title') }}</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $data)
                                <tr>
                                    <td>{{$data['id']}}</td>
                                    <td>{{$data['title'][language()]}}</td>
                                    <td><span class="active-mark"><i class="fa-regular fa-{{$data['active']? 'check': ''}}"></i></span> {{$data['active'] ? 'Akiv': "Aktiv deyil"}}</td>
                                    <td>
                                        <div class="digi-dropdown dropdown d-inline-block">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="fa-regular fa-angle-down"></i></button>
                                            <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                <li><a href="{{ route('questions.show',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>

                                                <li><a href="{{ route('questions.edit',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-pen-to-square"></i></span>  {{ __('content.edit') }}</a></li>
                                                <!-- Delete düyməsi (modal açır) -->

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="table-bottom-control"></div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="panel">
                    <div class="panel-header">
                        <h5>{{ __('content.exams') }}</h5>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped" id="allEmployeeTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('validation.attributes.title') }}</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $data)
                                <tr>
                                    <td>{{$data['id']}}</td>
                                    <td>{{$data['title'][language()]}}</td>
                                    <td><span class="active-mark"><i class="fa-regular fa-{{$data['active']? 'check' : '' }}"></i></span> {{$data['active'] ? 'Akiv': "Aktiv deyil"}}</td>
                                    <td>
                                        <div class="digi-dropdown dropdown d-inline-block">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="fa-regular fa-angle-down"></i></button>
                                            <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                {{--                                                <li><a href="{{ route('exams.show',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>--}}

                                                <li><a href="{{ route('exams.edit',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-pen-to-square"></i></span>  {{ __('content.edit') }}</a></li>
                                                <!-- Delete düyməsi (modal açır) -->

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="table-bottom-control"></div>
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
