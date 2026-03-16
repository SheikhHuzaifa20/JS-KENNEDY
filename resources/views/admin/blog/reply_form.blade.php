@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reply to Comment</h4>
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <!-- Original Comment -->
                            <div class="card mb-4 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <strong>Original Comment</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Name:</strong> {{ $comment->name }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Email:</strong> {{ $comment->email }}
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y h:i A') }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <strong>Message:</strong>
                                            <p class="mt-2 p-3 bg-light rounded">{{ $comment->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Reply Form -->
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <strong>Write Your Reply</strong>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.blog-review.reply-store') }}" method="POST">
                                        @csrf
                                        
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="blog_id" value="{{ $comment->blog_id }}">
                                        
                                        <div class="form-group">
                                            <label for="message">Reply Message <span class="text-danger">*</span></label>
                                            <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required placeholder="Type your reply here..."></textarea>
                                            @error('message')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group text-right">
                                            <a href="{{ route('admin.blog-review.show', $comment->blog_id) }}" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-success">Post Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection