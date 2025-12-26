@extends('site.user.layouts.app')
@section('site.user.css')
    <style>
        .contact-action-item a {
            font-size: 15px;
            text-decoration: underline;
        }
        .is-invalid {
            border: 1px solid red !important;
        }
        .text-danger {
            font-size: 13px;
            margin-top: 4px;
        }

    </style>
@endsection
@section('site.user.content')
    <div class="main-content-wrapper">
        <div class="container-fluid">

            <!-- Student Top Start -->
            <div class="admin-top-bar students-top">
                <div class="courses-select">

                    <h4 class="title">{{ __('site.add_child') }}</h4>
                </div>
            </div>
            <!-- Student Top End -->

            <div class="settings-wrapper">
                <div class="card">
                    <div class="card-body">

                        <form id="childForm"  action="{{ route('site.user.children.save',['locale' => app()->getLocale()]) }}" method="POST">
                            @csrf
                            <!-- Name -->
                            <div class="form-group mb-3">
                                <label>{{ __('site.name') }}</label>
                                <input type="text"
                                       name="name"
                                       class="form-control">
                                <span class="text-danger error-text name_error"></span>
                            </div>

                            <!-- Surname -->
                            <div class="form-group mb-3">
                                <label>{{ __('site.surname') }}</label>
                                <input type="text"
                                       name="surname"
                                       class="form-control">

                                <span class="text-danger error-text surname_error"></span>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label>{{ __('site.classes') }}</label>
                                <select name="class_id" class="form-control">
                                    <option value="">{{ __('site.all_class') }}</option>
                                    @if(!empty($classes[0]))
                                        @foreach($classes as $class)
                                            <option value="{{$class['id']}}">{{ $class['name'][language()] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger error-text class_id_error"></span>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-success">
                                {{ __('site.save') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('site.user.js')
    <script>
        $('#childForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);

            $('.error-text').text('');
            $('input').removeClass('is-invalid');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            $('input[name="'+key+'"]').addClass('is-invalid');
                            $('select[name="'+key+'"]').addClass('is-invalid');
                            $('.'+key+'_error').text(value[0]);
                        });
                    }
                }
            });
        });
    </script>
@endsection
