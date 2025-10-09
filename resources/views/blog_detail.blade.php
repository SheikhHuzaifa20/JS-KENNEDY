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
    </style>
@endsection

@section('content')


    <section class="hm-banner inner-banners" id="blogdetail">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="main-book-sldier">
                        <div class="inner-banner-heading">
                            {!! $blog->short_detail !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <img src="{{ asset($blog->image) }}" alt="Fantasy">
                        {!! $blog->inner_detail !!}
                    </div>
                </div>
                <div class="col-lg-4">
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
                </div>
            </div>
        </div>
    </section>


    <section class="blog-comments mt-5">
        <div class="container">
            <div class="row">
                <!-- Comment Form -->
                <div class="col-lg-8">
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

                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5"><label
                                    for="star5">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4"><label
                                    for="star4">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3"><label
                                    for="star3">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2"><label
                                    for="star2">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1"><label
                                    for="star1">&#9733;</label>
                            </div>

                            <button type="submit" class="btn-submit">Post Comment</button>
                        </form>

                    </div>
                </div>

                <!-- Recent Reviews -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="reviews-card shadow">
                        <h3>Recent Reviews</h3>
                        {{-- @dd($reviews) --}}
                        @forelse($reviews as $review)
                            <div class="single-review">
                                <div class="review-content">
                                    <div class="review-header">
                                        <strong>{{ $review->name }}</strong>
                                        <div class="review-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span>{!! $i <= $review->rating ? '&#9733;' : '&#9734;' !!}</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <p>"{{ $review->message }}"</p>
                                </div>
                            </div>
                        @empty
                            <p>No reviews yet. Be the first to comment!</p>
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
