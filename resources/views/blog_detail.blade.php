@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 33)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 33)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp

@extends('layouts.app')
@section('title', 'Home')

@section('css')
    <style>
        .card.bg-black {
            background-color: black !important;
        }

        .card.bg-black p {
            color: white !important;
        }

        /* Card styles */
        .comment-form-card,
        .reviews-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
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
        }

        /* Form Inputs */
        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 15px;
        }

        .comment-form input:focus,
        .comment-form textarea:focus {
            border-color: #000;
        }

        /* Form Row */
        .comment-form .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        /* Button */
        .btn-submit {
            background: #000;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #333;
        }

        /* Star Rating Form */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
        }

        /* Reviews */
        .single-review {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .single-review:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .review-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
            margin-bottom: 8px;
        }

        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #eee;
        }

        .review-stars span {
            color: gold;
            font-size: 14px;
            margin-right: 2px;
        }

        .single-review p {
            font-size: 14px;
            color: #555;
            margin: 0;
        }

        #blogdetail.inner-banner-heading h1 {
            text-align: center;
            text-transform: uppercase;
            color: var(--white-color);
            font-size: 60px;
            font-family: "Libre Baskerville", serif;
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
                <div class="col-lg-8 col-md-8 col-12">
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
                    <div class="card text-center p-4">
                        <img src="{{ asset($sections[10]->value) }}" alt="Author"
                            style="width:150px; height:150px; border-radius:12px; object-fit:cover; margin:0 auto;">
                        <h3 class="mt-3" style="font-weight:bold; text-transform:uppercase;">About the Author</h3>
                        <p class="mt-2" style="max-width:500px; margin:0 auto; font-size:15px; line-height:1.6;">
                            JS Kennedy is the pseudonym of Canadian author Jacqueline Kennedy,
                            a storyteller with a vivid imagination and a determination to write
                            the kinds of characters she always wanted to read.
                        </p>
                        <div style="width:60px; height:3px; background:black; margin:15px auto 0 auto;"></div>
                    </div>

                    @if ($polls->count() > 0)
                        <div class="poll-section mt-5 p-4 rounded shadow-sm"
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
                <div class="col-lg-4 col-md-4 col-12 mt-4 mt-lg-0">
                    <div class="reviews-card shadow">
                        <h3>Comment</h3>
                        {{-- @dd($reviews) --}}
                        @forelse($reviews as $review)
                            <div class="single-review">
                                <div class="review-content">
                                    <div class="review-header">
                                        <strong>{{ $review->name }}</strong>
                                    </div>
                                    <p>"{{ $review->message }}"</p>
                                </div>
                            </div>
                        @empty
                            <p>No Comment yet. Be the first to comment!</p>
                        @endforelse

                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection

@section('js')
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
