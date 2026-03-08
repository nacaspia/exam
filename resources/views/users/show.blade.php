@extends('layouts.app')
@section('title')
    {{ __('content.show') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/jquery.dataTables.min.css') }}">
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
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active"  data-bs-toggle="tab"
                                   href="#about" role="tab">
                                    <span class="d-none d-sm-block">Məlumatlar</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link"  data-bs-toggle="tab"
                                   href="#payment" role="tab">
                                    <span class="d-none d-sm-block">Ödənişləri</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link"  data-bs-toggle="tab"
                                   href="#exam" role="tab">
                                    <span class="d-none d-sm-block">Imtahanlar</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="about" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <label class="form-label">{{ __('validation.attributes.name') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $user['name'] ?? old('name') }}" readonly>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <label class="form-label">{{ __('validation.attributes.surname') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="surname" value="{{ $user['surname'] ?? old('surname') }}" readonly>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <label class="form-label">{{ __('validation.attributes.email') }}</label>
                                        <input type="email" class="form-control form-control-sm" name="email" value="{{ $user['email'] ?? old('email') }}" readonly>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <label class="form-label">{{ __('validation.attributes.phone') }}</label>
                                        <input type="tel" class="form-control form-control-sm" name="phone" value="{{ $user['phone'] ?? old('phone') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="payment" role="tabpanel">
                                <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imtahan</th>
                                        <th>Məbləğ</th>
                                        <th>Status</th>
                                        <th>Ödənişi etdiyi Tarix</th>
                                        <th>Ödənişi tamamladıqı Tarix</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($user['payments'][0]))
                                        @foreach($user['payments'] as $payment)
                                            <tr>
                                                <td>{{$payment['id']}}</td>
                                                <td>{{ $payment['exam']['title'][language()] }}</td>
                                                <td>{{$payment['amount']}}</td>
                                                <td><span class="active-mark"><i class="fa-regular fa-check"></i></span> {{$payment['status'] === 'pending' ? 'Gözləyir': "Tamamlanıb"}}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($payment['created_at'])) }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($payment['updated_at'])) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>Melumat yoxdur</p>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="exam" role="tabpanel">
                                <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped"  id="allEmployeeTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Başlıq</th>
                                        <th>Düzgün cavab sayı</th>
                                        <th>Sərf etdiyi vaxt</th>
                                        <th>Status</th>
                                        <th>Başladıqı Tarix</th>
                                        <th>Bitirdiyi Tarix</th>
                                        <th>Daha ətraflı</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($user['exam_results'][0]))
                                        @foreach($user['exam_results'] as $examResult)
                                            <tr>
                                                <td>{{$examResult['id']}}</td>
                                                <td>{{ $examResult['exam']['title'][language()] }}</td>
                                                <td>{{$examResult['total_score']}} </td>
                                                <td>{{$examResult['time_spent']}} saniye</td>
                                                <td><span class="active-mark"><i class="fa-regular fa-check"></i></span> {{$examResult['status'] === 'pending' ? 'Gözləyir': "Tamamlanıb"}}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($examResult['started_at'])) }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($examResult['finished_at'])) }}</td>
                                                <td>
                                                    <div class="digi-dropdown dropdown d-inline-block">
                                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="fa-regular fa-angle-down"></i></button>
                                                        <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                            <li><a href="{{ route('users.exam',['userId' => $examResult['user_id'], 'examId' => $examResult['id']]) }}" target="_blank" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                        <p>Melumat yoxdur</p>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="table-bottom-control"></div>
                            </div>
                        </div>
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
    <script src="{{ asset('assets/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
