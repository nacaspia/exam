@extends('layouts.app')
@section('title')
    {{ __('content.questions') }}
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
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-header">
                        <h5>{{ __('content.questions') }}</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                            <button class="btn btn-sm btn-icon btn-outline-primary"><i class="fa-light fa-arrows-rotate"></i></button>
                            <a href="{{ route('questions.create') }}" class="btn btn-sm btn-primary"><i class="fa-light fa-plus"></i>{{ __('content.new') }}</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped" id="allEmployeeTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('validation.attributes.title') }}</th>
{{--                                <th>Status</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $data)
                                <tr>
                                    <td>{{$data['id']}}</td>
                                    <td>{{$data['title'][language()]}}</td>
{{--                                    <td><span class="active-mark"><i class="fa-regular fa-check"></i></span> {{$data['status'] ? 'Akiv': "Aktiv deyil"}}</td>--}}
                                    <td>
                                        <div class="digi-dropdown dropdown d-inline-block">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="fa-regular fa-angle-down"></i></button>
                                            <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                <li><a href="{{ route('questions.show',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>

                                                <li><a href="{{ route('questions.edit',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-pen-to-square"></i></span>  {{ __('content.edit') }}</a></li>
                                                <!-- Delete düyməsi (modal açır) -->
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $data['id'] }}">
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
        @foreach($questions  as $delete)
            <div class="modal fade" id="deleteModal-{{ $delete['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $delete['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $delete['id'] }}">{{ __('content.delete') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ __('content.are_you_delete') }} <strong>{{ $delete['title'][language()] }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.cancel') }}</button>

                            <form action="{{ route('questions.destroy', $delete['id']) }}" method="POST" class="delete-role-form">
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
    <script src="{{ asset('assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
@endsection
