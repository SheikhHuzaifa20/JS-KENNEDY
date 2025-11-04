@extends('layouts.admin.app')

@push('before-css')
    <link rel="stylesheet" href="{{ asset('plugins/vendors/dropify/dist/css/dropify.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        section#basic-form-layouts li span {
            padding-left: 10px;
        }

        section#basic-form-layouts li button {
            left: -13px;
        }

        .heightcard {
            height: unset !important;
        }
    </style>
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Create New Poll</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Polls</li>
                        <li class="breadcrumb-item active">Create New Poll</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-7">
                    <div class="card heightcard">
                        <div class="card-header">
                            <h4 class="card-title">Create New Poll</h4>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form action="{{ route('admin.polls.store') }}" method="POST">
                                    @csrf

                                    {{-- ✅ Select Blogs --}}
                                    <div class="mb-3">
                                        <label for="blog_id" class="form-label fw-bold">Select Blogs</label>
                                        <select class="form-control select2" id="blog_id" name="blog_id[]" multiple
                                            data-placeholder="Select blogs...">
                                            @foreach ($blogs as $blog)
                                                <option value="{{ $blog->id }}">
                                                    {!! html_entity_decode(strip_tags($blog->short_detail)) !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- ✅ Poll Question --}}
                                    <div class="mb-3">
                                        <label for="question" class="form-label fw-bold">Poll Question</label>
                                        <input type="text" name="question" id="question" class="form-control"
                                            placeholder="Enter poll question..." required>
                                    </div>

                                    {{-- ✅ Poll Options --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Poll Options</label>
                                        <div id="options-wrapper">
                                            <div class="input-group mb-2">
                                                <input type="text" name="options[]" class="form-control"
                                                    placeholder="Enter option 1" required>
                                                <button type="button" class="btn btn-danger remove-option">X</button>
                                            </div>
                                        </div>

                                        <button type="button" id="add-option" class="btn btn-secondary mt-2">
                                            + Add Option
                                        </button>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-black px-5 py-2">Save Poll</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Right Info Section --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Information</h4>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="card-text">
                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="alert alert-danger">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if (Session::has('message'))
                                        <ul>
                                            <li class="alert alert-success">
                                                {{ Session::get('message') }}
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('.dropify').dropify();

            // ✅ Initialize Select2
            $('#blog_id').select2({
                width: '100%',
                placeholder: $('#blog_id').data('placeholder'),
                allowClear: true
            });

            // ✅ Dynamic poll options
            $('#add-option').on('click', function() {
                $('#options-wrapper').append(`
                    <div class="input-group mb-2">
                        <input type="text" name="options[]" class="form-control" placeholder="Enter another option" required>
                        <button type="button" class="btn btn-danger remove-option">X</button>
                    </div>
                `);
            });

            $(document).on('click', '.remove-option', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endpush
