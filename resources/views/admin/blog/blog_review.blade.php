@extends('layouts.admin.app')

@push('before-css')
    <link href="{{ asset('plugins/components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<style>
    .star-rating {
        display: inline-flex;
        align-items: center;
    }

    .star {
        font-size: 20px;
        color: #ccc;
        /* Empty star color */
        margin-right: 2px;
        transition: color 0.2s ease;
    }

    .star.filled {
        color: #f7d106;
        /* Filled star color (gold) */
    }
</style>

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Contact Inquiries</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Inquires</li>
                        <li class="breadcrumb-item active">Contact Inquiries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Contact Inquiries Info</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Type</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inquiry as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    {{ Str::limit($item->message, 50) }}
                                                    @if ($item->parent_id)
                                                        <span class="badge badge-info ml-2">Reply</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->parent_id)
                                                        <span class="badge badge-success">Reply</span>
                                                    @else
                                                        <span class="badge badge-primary">Main Comment</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ url('blog-review/view/' . $item->id) }}"
                                                        class="btn btn-info btn-sm" title="View">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>View
                                                    </a>

                                                    @if (!$item->parent_id && !$item->has_admin_reply)
                                                        <!-- Reply button only for main comments without admin replies -->
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-toggle="modal" data-target="#replyModal{{ $item->id }}"
                                                            title="Reply">
                                                            <i class="fa fa-reply"></i>Reply
                                                        </button>
                                                    @endif

                                                    <a href="{{ url('blog-review/delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        title="Delete">
                                                        <i class="fa fa-trash-o"></i>Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Reply Modal for each comment -->
                                            @if (!$item->parent_id && !$item->has_admin_reply)
                                                <div class="modal fade" id="replyModal{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="replyModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="replyModalLabel{{ $item->id }}">Reply to
                                                                    {{ $item->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('admin.blog-review.reply-store') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul class="mb-0">
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif

                                                                    <div class="form-group">
                                                                        <label>Original Comment:</label>
                                                                        <div class="p-3 bg-light rounded">
                                                                            <strong>{{ $item->name }}:</strong>
                                                                            <p class="mb-0">{{ $item->message }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="message">Your Reply <span
                                                                                class="text-danger">*</span>:</label>
                                                                        <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                                                                            required placeholder="Write your reply here...">{{ old('message') }}</textarea>
                                                                        @error('message')
                                                                            <span
                                                                                class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <input type="hidden" name="parent_id"
                                                                        value="{{ $item->id }}">
                                                                    <input type="hidden" name="blog_id"
                                                                        value="{{ $blog->id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Post
                                                                        Reply</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/components/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('plugins/components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function() {

            @if (\Session::has('success'))
                $.toast({
                    heading: 'Success!',
                    position: 'top-center',
                    text: '{{ session()->get('success') }}',
                    loaderBg: '#28a745',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
            @endif

            @if (\Session::has('message'))
                $.toast({
                    heading: 'Success!',
                    position: 'top-center',
                    text: '{{ session()->get('message') }}',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
            @endif
        })

        $(function() {
            $('.zero-configuration').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>
@endpush
