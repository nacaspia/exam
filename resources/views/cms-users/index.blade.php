@extends('layouts.app')
@section('title')
    {{ __('content.cms_users') }}
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
                        <h5>{{ __('content.cms_users') }}</h5>
                        <div class="btn-box d-flex flex-wrap gap-2">
                            <div id="tableSearch"></div>
                            <button class="btn btn-sm btn-icon btn-outline-primary"><i class="fa-light fa-arrows-rotate"></i></button>
                            <div class="digi-dropdown dropdown">
                                <button class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="fa-regular fa-ellipsis-vertical"></i></button>
                                <ul class="digi-dropdown-menu dropdown-menu">
                                    <li class="dropdown-title">Show Table Title</li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showEmployeeId" checked>
                                            <label class="form-check-label" for="showEmployeeId">
                                                Employee ID
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showPhoto" checked>
                                            <label class="form-check-label" for="showPhoto">
                                                Photo
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showName" checked>
                                            <label class="form-check-label" for="showName">
                                                Name
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showSection" checked>
                                            <label class="form-check-label" for="showSection">
                                                Section
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showPhone" checked>
                                            <label class="form-check-label" for="showPhone">
                                                Phone
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showPresentAddress" checked>
                                            <label class="form-check-label" for="showPresentAddress">
                                                Present Address
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="showStatus" checked>
                                            <label class="form-check-label" for="showStatus">
                                                Status
                                            </label>
                                        </div>
                                    </li>
                                    <li class="dropdown-title pb-1">Showing</li>
                                    <li>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-control-sm w-50" value="10">
                                            <button class="btn btn-sm btn-primary w-50">Apply</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('cms-users.create') }}" class="btn btn-sm btn-primary"><i class="fa-light fa-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-filter-option">
                            <div class="row g-3">
                                <div class="col-xl-10 col-9 col-xs-12">
                                    <div class="row g-3">
                                        <div class="col">
                                            <form class="row g-2">
                                                <div class="col">
                                                    <select class="form-control form-control-sm">
                                                        <option value="0">Bulk action</option>
                                                        <option value="1">Move to trash</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-sm btn-primary w-100">Apply</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <select class="form-control form-control-sm">
                                                <option value="0">Active</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Inactive</option>
                                                <option value="3">Hold</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-sm btn-primary"><i class="fa-light fa-filter"></i> Filter</button>
                                        </div>
                                        <div class="col">
                                            <div class="digi-dropdown dropdown">
                                                <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="fa-regular fa-plus"></i></button>
                                                <ul class="digi-dropdown-menu dropdown-menu">
                                                    <li class="dropdown-title">Filter Options</li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="filterActiveStatus" checked>
                                                            <label class="form-check-label" for="filterActiveStatus">
                                                                Active Status
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-3 col-xs-12 d-flex justify-content-end">
                                    <div id="employeeTableLength"></div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dashed table-hover digi-dataTable all-employee-table table-striped" id="allEmployeeTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cmsUsers as $data)

                                <tr>
                                    <td>{{$data['id']}}</td>
                                    <td>
                                        <div class="avatar">
                                            @if($data['image'])
                                                <img src="{{asset('storage/cms_users/' . $data['image'])}}" alt="User">
                                            @else
                                                <img src="{{ asset('assets/images/admin.png') }}" alt="User">
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$data['name']}} {{$data['surname']}}</td>
                                    <td>{{$data['username']}}</td>
                                    <td>{{$data['roles'][0]['name']}}</td>
                                    <td>{{$data['phone']}}</td>
                                    <td><span class="active-mark"><i class="fa-regular fa-check"></i></span> {{$data['status'] ? 'Akiv': "Aktiv deyil"}}</td>
                                    <td>
                                        <div class="digi-dropdown dropdown d-inline-block">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="fa-regular fa-angle-down"></i></button>
                                            <ul class="digi-dropdown-menu dropdown-menu dropdown-slim dropdown-menu-sm">
                                                <li><a href="{{ route('cms-users.show',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-eye"></i></span> {{ __('content.view') }}</a></li>
                                                @if($data['username'] != 'super_admin')
                                                    <li><a href="{{ route('cms-users.edit',$data['id']) }}" class="dropdown-item"><span class="dropdown-icon"><i class="fa-light fa-pen-to-square"></i></span>  {{ __('content.edit') }}</a></li>
                                                    <!-- Delete düyməsi (modal açır) -->
                                                    <li>
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $data['id'] }}">
                                                            <span class="dropdown-icon"><i class="fa-light fa-trash-can"></i></span> {{ __('content.delete') }}
                                                        </button>
                                                    </li>
                                                @endif
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
        @foreach($cmsUsers  as $cmsUserDelete)
            @if($cmsUserDelete['username'] != 'super_admin')
            <div class="modal fade" id="deleteModal-{{ $cmsUserDelete['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $cmsUserDelete['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel-{{ $cmsUserDelete['id'] }}">{{ __('content.delete') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ __('content.are_you_delete') }} <strong>{{ $cmsUserDelete['name'] }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.cancel') }}</button>

                            <form action="{{ route('cms-users.destroy', $cmsUserDelete['id']) }}" method="POST" class="delete-role-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('content.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
