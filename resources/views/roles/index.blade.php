@extends('layouts.app')
@section('title')
    {{ __('content.roles') }}
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
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                @include('errors.messages')
                <div class="panel">
                    <div class="panel-header">
                        <h5>{{ __('content.roles') }}</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary"><i class="fa-light fa-plus"></i> {{ __('content.new') }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('content.title') }}</th>
                                <th>{{ __('content.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles  as $role)
                                <tr>
                                    <td>{{$role['id']}}</td>
                                    <td>{{$role['name']}}</td>
                                    <td>
                                        <div class="digi-dropdown dropdown d-inline-block">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">{{ __('content.choose') }} <i class="fa-regular fa-angle-down"></i></button>
                                            <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                <li><a href="{{ route('roles.show',$role['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>
                                                <li><a href="{{ route('roles.edit',$role['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-pen-to-square"></i></span>  {{ __('content.edit') }}</a></li>
                                                <!-- Delete düyməsi (modal açır) -->
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $role['id'] }}">
                                                        <span class="dropdown-icon"><i class="fa-light fa-trash-can"></i></span> {{ __('content.delete') }}
                                                    </button>
                                                </li>

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
        @foreach($roles  as $role)
            <div class="modal fade" id="deleteModal-{{ $role['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $role['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $role['id'] }}">{{ __('content.delete') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ __('content.are_you_delete') }} <strong>{{ $role['name'] }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.cancel') }}</button>

                            <form action="{{ route('roles.destroy', $role['id']) }}" method="POST" class="delete-role-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('content.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')

    <!-- jQuery əvvəlcə yüklənir -->
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
