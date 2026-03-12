@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 33)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 33)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp

@extends('layouts.app')
@section('title', 'Home')

@section('css')
    <style>
        /* Card styles */
        .comment-form-card,
        .reviews-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px 1px rgb(0 0 0 / 66%) !important;
        }

        .comment-form-card:hover,
        .reviews-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Titles */
        .comment-form-card h3,
        .reviews-card h3 {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        /* Alerts */
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        /* Form Inputs */
        .comment-form input,
        .comment-form textarea,
        .reply-form input,
        .reply-form textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 15px;
            background: #fff;
        }

        .comment-form input:focus,
        .comment-form textarea:focus,
        .reply-form input:focus,
        .reply-form textarea:focus {
            border-color: #000;
        }

        /* Form Row */
        .comment-form .form-row,
        .reply-form .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        /* Buttons */
        .btn-submit {
            background: #000;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            background: #333;
        }

        .reply-btn {
            background: none;
            border: none;
            color: #000;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 5px 0;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .reply-btn:hover {
            color: #333;
        }

        .submit-reply-btn {
            background: #000;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit-reply-btn:hover {
            background: #333;
        }

        .cancel-btn {
            background: #f0f0f0;
            color: #666;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
        }

        .cancel-btn:hover {
            background: #e0e0e0;
        }

        /* Comments */
        .single-review {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .single-review:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .review-header strong {
            font-size: 15px;
            color: #333;
        }

        .comment-date {
            font-size: 11px;
            color: #999;
        }

        .comment-message {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            line-height: 1.5;
        }

        /* Replies Section */
        .replies-section {
            margin-left: 20px;
            margin-top: 10px;
            padding-left: 15px;
            border-left: 2px solid #ddd;
        }

        .single-reply {
            padding: 10px 0;
            border-bottom: 1px dashed #eee;
        }

        .single-reply:last-child {
            border-bottom: none;
        }

        .reply-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .reply-icon {
            color: #999;
            font-size: 10px;
        }

        .reply-header strong {
            color: #333;
        }

        .reply-date {
            font-size: 10px;
            color: #999;
            margin-left: auto;
        }

        .reply-message {
            font-size: 13px;
            color: #666;
            margin-left: 18px;
            line-height: 1.4;
        }

        /* Reply Form */
        .reply-form-container {
            margin: 10px 0;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 12px;
        }

        .reply-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        /* No Comments */
        .no-comments {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 20px;
        }

        /* Blog Content */
        .blog-content {
            padding: 20px;
            background: #fff;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 0 15px 1px rgb(0 0 0 / 66%);
        }

        .inner-banner-heading h1 {
            text-align: center;
            text-transform: uppercase;
            color: #333;
            font-size: 60px;
            font-family: "Libre Baskerville", serif;
            margin: 30px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .comment-form .form-row,
            .reply-form .form-row {
                flex-direction: column;
                gap: 10px;
            }

            .inner-banner-heading h1 {
                font-size: 40px;
            }
        }
    </style>
@endsection

@section('content')


    <section class="hm-banner inner-banners" id="blogdetail">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="main-book-sldier">
                        <div class="inner-banner-heading">
                            <h1>
                                {{ $blog->short_detail }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card bg-black">
                        <img src="{{ asset($blog->image) }}" alt="Fantasy">
                        @if (!empty($blog->event_datetime))
                            @php
                                $releaseDate = \Carbon\Carbon::parse($blog->event_datetime);
                            @endphp
                            <p class="mt-2 text-muted">
                                🗓️
                                <strong>{{ $releaseDate->format('F d, Y') }}</strong>
                                at
                                <strong>{{ $releaseDate->format('h:i A') }}</strong>.
                            </p>
                        @endif
                        {!! $blog->detail !!}
                    </div>


                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    @foreach ($polls as $poll)
                        <div class="single-poll mb-4 p-4 rounded shadow"
                            style="background:white; border:1px solid #dcdcdc;">
                            <h6 class="fw-bold mb-3" style="color:#222;">{{ $poll->question }}</h6>

                            @php
                                // JSON data ko safely decode karein
                                $options = [];

                                if (is_string($poll->options)) {
                                    // Pehle JSON decode try karein
                                    $decoded = json_decode($poll->options, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $options = $decoded;
                                    } else {
                                        // Agar JSON decode na ho to comma separated assume karein
                                        $options = explode(',', $poll->options);
                                    }
                                } elseif (is_array($poll->options)) {
                                    // Already array hai
                                    $options = $poll->options;
                                } else {
                                    // Fallback
                                    $options = ['Option 1', 'Option 2'];
                                }

                                // Ensure options array clean ho
                                $options = array_map('trim', $options);
                                $options = array_filter($options); // Empty values remove karein

                                $results = $pollResults[$poll->id] ?? ['total' => 0, 'percentages' => []];
                            @endphp

                            <ul class="list-unstyled mt-2">
                                @foreach ($options as $index => $option)
                                    @php
                                        $percent = $results['percentages'][$index] ?? 0;
                                        // Ensure percent valid ho
                                        $percent = is_numeric($percent) ? $percent : 0;
                                    @endphp
                                    <li class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>{{ $option }}</span>
                                            <span class="fw-bold">{{ $percent }}%</span>
                                        </div>
                                        <div class="progress" style="height: 8px; background:#eee;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $percent }}%; background:#1a1a1a;"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="text-muted mt-2" style="font-size:13px;">
                                Total Votes: <strong>{{ $results['total'] ?? 0 }}</strong>
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    {{-- <div class="card text-center p-4">
                        <img src="{{ asset($sections[10]->value) }}" alt="Author"
                            style="width:150px; height:150px; border-radius:12px; object-fit:cover; margin:0 auto;">
                        <h3 class="mt-3" style="font-weight:bold; text-transform:uppercase;">About the Author</h3>
                        <p class="mt-2" style="max-width:500px; margin:0 auto; font-size:15px; line-height:1.6;">
                            JS Kennedy is the pseudonym of Canadian author Jacqueline Kennedy,
                            a storyteller with a vivid imagination and a determination to write
                            the kinds of characters she always wanted to read.
                        </p>
                        <div style="width:60px; height:3px; background:black; margin:15px auto 0 auto;"></div>
                    </div> --}}

                    @if ($polls->count() > 0)
                        <div class="poll-section p-4 rounded shadow-sm"
                            style="background:#f9f9f9; border:1px solid #e5e5e5;">
                            <h4 class="text-center mb-4 fw-bold" style="color:#1a1a1a;">
                                🗳️ Participate in Polls
                            </h4>

                            @foreach ($polls as $poll)
                                @php
                                    // Check if current user already voted in this poll
                                    $userVote = null;
                                    $userId = auth()->id();

                                    if ($userId && isset($allVotes[$userId][$poll->id])) {
                                        $userVote = $allVotes[$userId][$poll->id];
                                    }

                                    // JSON data ko safely decode karein
                                    $options = [];

                                    if (is_string($poll->options)) {
                                        $decoded = json_decode($poll->options, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                            $options = $decoded;
                                        } else {
                                            $options = explode(',', $poll->options);
                                        }
                                    } elseif (is_array($poll->options)) {
                                        $options = $poll->options;
                                    } else {
                                        $options = ['Option 1', 'Option 2'];
                                    }

                                    $options = array_map('trim', $options);
                                    $options = array_filter($options);
                                @endphp

                                <div class="single-poll mb-4 p-4 rounded shadow"
                                    style="background:white; border:1px solid #dcdcdc; transition:all 0.3s ease;">
                                    <h6 class="fw-bold mb-3" style="color:#222;">{{ $poll->question }}</h6>

                                    @if ($userVote)
                                        {{-- User already voted - Show results with their selection --}}
                                        <div class="alert alert-info mb-3"
                                            style="background:#e7f3ff; border-color:#b3d9ff;">
                                            <strong>✓ You already voted in this poll!</strong>
                                        </div>

                                        @php
                                            $results = $pollResults[$poll->id] ?? ['total' => 0, 'percentages' => []];
                                        @endphp

                                        <ul class="list-unstyled mt-2">
                                            @foreach ($options as $index => $option)
                                                @php
                                                    $percent = $results['percentages'][$index] ?? 0;
                                                    $percent = is_numeric($percent) ? $percent : 0;
                                                    $isUserVote = trim($userVote) === trim($option);
                                                @endphp
                                                <li class="mb-3">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span>
                                                            {{ $option }}
                                                            @if ($isUserVote)
                                                                <span class="badge bg-success ms-2">Your Vote</span>
                                                            @endif
                                                        </span>
                                                        <span class="fw-bold">{{ $percent }}%</span>
                                                    </div>
                                                    <div class="progress" style="height: 8px; background:#eee;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $percent }}%; background:#1a1a1a;"></div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <p class="text-muted mt-2" style="font-size:13px;">
                                            Total Votes: <strong>{{ $results['total'] ?? 0 }}</strong>
                                        </p>
                                    @else
                                        {{-- User hasn't voted yet - Show voting form --}}
                                        <form method="POST" action="{{ route('poll.vote') }}" class="poll-form">
                                            @csrf

                                            <ul class="list-unstyled mt-2">
                                                @foreach ($options as $index => $option)
                                                    <li class="mb-2">
                                                        <label class="option-label d-flex align-items-center"
                                                            style="gap:8px; cursor:pointer; color:#333;">
                                                            <input type="radio" name="vote"
                                                                value="{{ $option }}" class="form-check-input me-2"
                                                                style="accent-color:#1a1a1a;" required>
                                                            {{ $option }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                                            @guest
                                                <a href="{{ route('register') }}" class="btn w-100 mt-3"
                                                    style="background:#1a1a1a; color:white; border:none; border-radius:8px; padding:8px 0; font-weight:600;">
                                                    Login to Vote
                                                </a>
                                            @else
                                                <button type="submit" class="btn w-100 mt-3"
                                                    style="background:#1a1a1a; color:white; border:none; border-radius:8px; padding:8px 0; font-weight:600;">
                                                    Vote
                                                </button>
                                            @endguest
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <section class="blog-comments mt-5">
        <div class="container">
            <div class="row">
                <!-- Comment Form -->
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="comment-form-card shadow">
                        <h3>Leave a Comment</h3>
                        @if (session('success'))
                            <div
                                style="background: #d4edda; color: #155724; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px;">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error messages --}}
                        @if ($errors->any())
                            <div
                                style="background: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px;">
                                <ul style="margin:0; padding-left:20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('blog.review.store', $blog->id) }}" method="POST" class="comment-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <input type="email" name="email" placeholder="Your Email" required>
                            </div>
                            <textarea name="message" placeholder="Your Comment" rows="5" required></textarea>
                            <button type="submit" class="btn-submit">Post Comment</button>
                        </form>

                    </div>
                </div>

                <!-- Recent Reviews -->
                <!-- Recent Reviews -->
                <div class="col-lg-4 col-md-4 col-12 mt-4 mt-lg-0">
                    <div class="reviews-card shadow">
                        <h3>Comments</h3>

                        @forelse($reviews->where('parent_id', null) as $review)
                            <div class="comment-thread" id="comment-{{ $review->id }}">
                                <!-- Main Comment -->
                                <div class="single-review">
                                    <div class="review-header">
                                        <strong>{{ $review->name }}</strong>
                                        <span
                                            class="comment-date">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <p class="comment-message">"{{ $review->message }}"</p>

                                    <!-- Reply Button -->
                                    @auth
                                        <button class="reply-btn" onclick="toggleReplyForm({{ $review->id }})">
                                            <i class="fas fa-reply"></i> Reply
                                        </button>

                                        <!-- Reply Form (Hidden by default) -->
                                        <div class="reply-form-container" id="reply-form-{{ $review->id }}"
                                            style="display: none;" data-blog-id="{{ $blog->id }}">
                                            <form onsubmit="submitReply(event, {{ $review->id }}, {{ $blog->id }})" class="reply-form" data-blog-id="{{ $blog->id }}" data-comment-id="{{ $review->id }}">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $review->id }}">
                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                                                <textarea name="message" placeholder="Write your reply..." rows="3" required></textarea>
                                                <div class="reply-actions">
                                                    <button type="button" class="cancel-btn"
                                                        onclick="toggleReplyForm({{ $review->id }})">Cancel</button>
                                                    <button type="submit" class="submit-reply-btn">Post Reply</button>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('login') }}" class="reply-btn" style="text-decoration: none;">
                                            <i class="fas fa-reply"></i> Login to Reply
                                        </a>
                                    @endauth

                                    <!-- Replies Section -->
                                    @php
                                        $replies = $reviews->where('parent_id', $review->id);
                                    @endphp

                                    @if ($replies->count() > 0)
                                        <div class="replies-section">
                                            @foreach ($replies as $reply)
                                                <div class="single-reply">
                                                    <div class="reply-header">
                                                        <i class="fas fa-reply reply-icon"></i>
                                                        <strong>{{ $reply->name }}</strong>
                                                        <span
                                                            class="reply-date">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="reply-message">{{ $reply->message }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- No replies for this comment yet -->
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="no-comments">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection

@section('js')
    <script>
        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            if (form.style.display === 'none' || form.style.display === '') {
                // Hide all other forms first
                document.querySelectorAll('.reply-form-container').forEach(f => f.style.display = 'none');
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

        function submitReply(event, commentId, blogId) {
            event.preventDefault();

            const form = event.target;
            
            // Create FormData from form
            const formData = new FormData(form);
            
            // Get values from hidden inputs
            const parentId = formData.get('parent_id');
            const currentBlogId = formData.get('blog_id');
            
            console.log('=== SUBMIT REPLY DEBUG ===');
            console.log('Parent ID (comment id):', parentId);
            console.log('Blog ID from form input:', currentBlogId);
            console.log('Blog ID from parameter:', blogId);
            console.log('Form data before sending:', {
                _token: formData.get('_token') ? 'Present' : 'Missing',
                parent_id: formData.get('parent_id'),
                blog_id: formData.get('blog_id'),
                name: formData.get('name'),
                email: formData.get('email'),
                message: formData.get('message')
            });

            // Show loading state
            const submitBtn = form.querySelector('.submit-reply-btn');
            const originalText = submitBtn.innerText;
            submitBtn.innerText = 'Posting...';
            submitBtn.disabled = true;

            fetch("{{ route('blog.review.reply') }}", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    console.log('Response Status:', response.status);
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(data => ({
                            ok: response.ok,
                            data: data,
                            status: response.status
                        }));
                    } else {
                        return response.text().then(text => ({
                            ok: response.ok,
                            data: { success: response.ok, message: text },
                            status: response.status
                        }));
                    }
                })
                .then(result => {
                    console.log('=== SERVER RESPONSE ===');
                    console.log('Status:', result.status);
                    console.log('Data:', result.data);

                    if (result.ok && result.data && result.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your reply has been posted successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else if (result.data && result.data.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: result.data.message,
                            showConfirmButton: true
                        });
                        submitBtn.innerText = originalText;
                        submitBtn.disabled = false;
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Reply posted successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                })
                .catch(error => {
                    console.error('=== FETCH ERROR ===');
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'Please try again.',
                        showConfirmButton: true
                    });
                    submitBtn.innerText = originalText;
                    submitBtn.disabled = false;
                });
        }
    </script>
    <script>
        const images = [
            "../asset/images/banner-back-1.png",
            "../asset/images/banner-back-2.png",
            "../asset/images/banner-back-3.png",
        ];

        const blogdetail = document.getElementById("blogdetail");
        let i = 0;


        blogdetail.style.backgroundImage = `url(${images[i]})`;

        setInterval(() => {
            i = (i + 1) % images.length;
            blogdetail.style.backgroundImage = `url(${images[i]})`;
        }, 6000);
    </script>
@endsection
