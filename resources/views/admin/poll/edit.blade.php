@extends('layouts.admin.app')
@push('before-css')
    <link rel="stylesheet" href="{{ asset('plugins/vendors/dropify/dist/css/dropify.min.css') }}">
@endpush
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        input.edit::placeholder {
            color: black;
        }

        section#basic-form-layouts li span {
            padding-left: 10px;
        }

        section#basic-form-layouts li button {
            left: -13px;
        }
    </style>

    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Edit Poll</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Polls</li>
                        <li class="breadcrumb-item active">Edit Poll</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Edit Poll</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form action="{{ route('poll.update', $poll->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- ✅ Select Blog (Select2 Added) --}}
                                    <div class="mb-3">
                                        <label for="blog_id" class="form-label fw-bold">Select Blogs</label>
                                        <select class="form-control select2" id="blog_id" name="blog_id[]" multiple>
                                            @foreach ($blogs as $blog)
                                                <option value="{{ $blog->id }}"
                                                    {{ in_array($blog->id, explode(',', $poll->blog_id)) ? 'selected' : '' }}>
                                                    {!! html_entity_decode(strip_tags($blog->short_detail)) !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    {{-- ✅ Poll Question --}}
                                    <div class="mb-3">
                                        <label for="question" class="form-label fw-bold">Poll Question</label>
                                        <input type="text" name="question" id="question" class="form-control edit"
                                            value="{{ $poll->question }}" required>
                                    </div>

                                    {{-- ✅ Poll Options --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Poll Options</label>
                                        <div id="options-wrapper">
                                            @php
                                                if (is_string($poll->options)) {
                                                    $options = json_decode($poll->options, true) ?? [];
                                                } else {
                                                    $options = is_array($poll->options) ? $poll->options : [];
                                                }
                                            @endphp

                                            @if (count($options) > 0)
                                                @foreach ($options as $index => $option)
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="options[]" class="form-control edit"
                                                            value="{{ $option }}"
                                                            placeholder="Enter option {{ $index + 1 }}" required>
                                                        {{-- Sirf yeh line change ki hai - @if ($index > 0) condition hata di --}}
                                                        <button type="button"
                                                            class="btn btn-danger remove-option">X</button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="input-group mb-2">
                                                    <input type="text" name="options[]" class="form-control edit"
                                                        placeholder="Enter option 1" required>
                                                    <button type="button" class="btn btn-danger remove-option">X</button>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <input type="text" name="options[]" class="form-control edit"
                                                        placeholder="Enter option 2" required>
                                                    <button type="button" class="btn btn-danger remove-option">X</button>
                                                </div>
                                            @endif
                                        </div>

                                        <button type="button" id="add-option" class="btn btn-secondary mt-2">+ Add
                                            Option</button>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-black px-5 py-2">Update Poll</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                                                <li class="alert alert-danger">
                                                    {{ $error }}
                                                </li>
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

    <!-- ✅ jQuery + Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#blog_id').select2({
                placeholder: "Select blogs...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>


    <!-- ✅ Existing Poll Option Add/Remove Script -->
    <script>
        document.getElementById('add-option').addEventListener('click', function() {
            const wrapper = document.getElementById('options-wrapper');
            const optionCount = wrapper.querySelectorAll('.input-group').length;
            const newOption = document.createElement('div');
            newOption.classList.add('input-group', 'mb-2');
            newOption.innerHTML = `
        <input type="text" name="options[]" class="form-control" placeholder="Enter option ${optionCount + 1}" required>
        <button type="button" class="btn btn-danger remove-option">X</button>
    `;
            wrapper.appendChild(newOption);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-option')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endpush
