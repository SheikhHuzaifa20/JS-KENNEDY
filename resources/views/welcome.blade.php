@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 33)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 33)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp
@extends('layouts.app')
@section('title', 'Home')

@section('css')
@endsection

@section('content')

    <section class="hm-banner" id="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-book-sldier">
                        <div class="banner-sliders owl-carousel owl-theme">
                            @foreach ($product2 as $product)
                                <div class="item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="banner-content">
                                                {!! $page->content !!}
                                                <div class="banner-btn">
                                                    <a href="https://www.amazon.com/stores/author/B095VMYZK1/allbooks?ingress=0&visitId=c70e2a7b-bf23-4070-a2f7-4b8cce80ccb2&ref_=ap_rdr"
                                                        class="btn btn-black">
                                                        Buy From Amazon
                                                        <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="banner-books">
                                                <div class="books-wanhu">
                                                    <div class="atropos my-atropos">
                                                        <div class="atropos-scale">
                                                            <div class="atropos-rotate">
                                                                <div class="atropos-inner">
                                                                    <a href="JavaScript:;" id="show"
                                                                        class="main-text-1">
                                                                        <img src="{{ asset($product->image) }}"
                                                                            class="img-fluid" alt=""
                                                                            data-atropos-offset="2">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="banner-content">
                                            <h1 class="typingheading">
                                                WELCOME TO
                                                <span class="d-block">
                                                    JS KENNEDY'S
                                                </span>
                                                WEBSITE
                                            </h1>
                                            <h2>
                                                MEET JS KENNEDY - CRAFTING WORLDS WHERE
                                                <span class="d-block">STRENGTH ENDURES</span>
                                            </h2>
                                            <p>
                                                JS Kennedy, the creative force behind the Mackenzie Green series, blends
                                                vivid imagination with a passion for strong, authentic characters.
                                                Drawing on a lifelong love of storytelling and her work as a Canadian
                                                Coast Guard Rescue Specialist, she creates engaging worlds where
                                                resilience, courage, and heart drive every adventure.
                                            </p>
                                            <div class="banner-btn">
                                                <a class="btn btn-black">
                                                    Buy From Amazon
                                                    <img src="{{asset("assets/images/amazon.png")}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{asset("assets/images/book-js66.png")}}" class="img-fluid"
                                                                        alt="" data-atropos-offset="2">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="banner-content">
                                            <h1 class="typingheading">
                                                WELCOME TO
                                                <span class="d-block">
                                                    JS KENNEDY'S
                                                </span>
                                                WEBSITE
                                            </h1>
                                            <h2>
                                                MEET JS KENNEDY - CRAFTING WORLDS WHERE
                                                <span class="d-block">STRENGTH ENDURES</span>
                                            </h2>
                                            <p>
                                                JS Kennedy, the creative force behind the Mackenzie Green series, blends
                                                vivid imagination with a passion for strong, authentic characters.
                                                Drawing on a lifelong love of storytelling and her work as a Canadian
                                                Coast Guard Rescue Specialist, she creates engaging worlds where
                                                resilience, courage, and heart drive every adventure.
                                            </p>
                                            <div class="banner-btn">
                                                <a class="btn btn-black">
                                                    Buy From Amazon
                                                    <img src="{{asset("assets/images/amazon.png")}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{asset("assets/images/book-js44.png")}}" class="img-fluid"
                                                                        alt="" data-atropos-offset="2">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="banner-content">
                                            <h1 class="typingheading">
                                                WELCOME TO
                                                <span class="d-block">
                                                    JS KENNEDY'S
                                                </span>
                                                WEBSITE
                                            </h1>
                                            <h2>
                                                MEET JS KENNEDY - CRAFTING WORLDS WHERE
                                                <span class="d-block">STRENGTH ENDURES</span>
                                            </h2>
                                            <p>
                                                JS Kennedy, the creative force behind the Mackenzie Green series, blends
                                                vivid imagination with a passion for strong, authentic characters.
                                                Drawing on a lifelong love of storytelling and her work as a Canadian
                                                Coast Guard Rescue Specialist, she creates engaging worlds where
                                                resilience, courage, and heart drive every adventure.
                                            </p>
                                            <div class="banner-btn">
                                                <a class="btn btn-black">
                                                    Buy From Amazon
                                                    <img src="{{asset("assets/images/amazon.png")}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show"
                                                                    class="main-text-1">
                                                                    <img src="{{asset("assets/images/book-js33.png")}}" class="img-fluid"
                                                                        alt="" data-atropos-offset="2">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="banner-content">
                                            <h1 class="typingheading">
                                                WELCOME TO
                                                <span class="d-block">
                                                    JS KENNEDY'S
                                                </span>
                                                WEBSITE
                                            </h1>
                                            <h2>
                                                MEET JS KENNEDY - CRAFTING WORLDS WHERE
                                                <span class="d-block">STRENGTH ENDURES</span>
                                            </h2>
                                            <p>
                                                JS Kennedy, the creative force behind the Mackenzie Green series, blends
                                                vivid imagination with a passion for strong, authentic characters.
                                                Drawing on a lifelong love of storytelling and her work as a Canadian
                                                Coast Guard Rescue Specialist, she creates engaging worlds where
                                                resilience, courage, and heart drive every adventure.
                                            </p>
                                            <div class="banner-btn">
                                                <a class="btn btn-black">
                                                    Buy From Amazon
                                                    <img src="{{asset("assets/images/amazon.png")}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show"
                                                                    class="main-text-1">
                                                                    <img src="{{asset("assets/images/book-js22.png")}}" class="img-fluid"
                                                                        alt="" data-atropos-offset="2">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="banner-content">
                                            <h1 class="typingheading">
                                                WELCOME TO
                                                <span class="d-block">
                                                    JS KENNEDY'S
                                                </span>
                                                WEBSITE
                                            </h1>
                                            <h2>
                                                MEET JS KENNEDY - CRAFTING WORLDS WHERE
                                                <span class="d-block">STRENGTH ENDURES</span>
                                            </h2>
                                            <p>
                                                JS Kennedy, the creative force behind the Mackenzie Green series, blends
                                                vivid imagination with a passion for strong, authentic characters.
                                                Drawing on a lifelong love of storytelling and her work as a Canadian
                                                Coast Guard Rescue Specialist, she creates engaging worlds where
                                                resilience, courage, and heart drive every adventure.
                                            </p>
                                            <div class="banner-btn">
                                                <a class="btn btn-black">
                                                    Buy From Amazon
                                                    <img src="{{asset("assets/images/amazon.png")}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show"
                                                                    class="main-text-1">
                                                                    <img src="{{asset("assets/images/book-js11.png")}}" class="img-fluid"
                                                                        alt="" data-atropos-offset="2">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="back-circle">
            <img src="{{ asset('assets/images/banner-circle.png') }}" class="img-fluid" alt="">
        </div>
    </section>

    <section class="serires-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="book-series">
                        <h2>{{ $sections[6]->value }}</h2>
                        <p>{{ $sections[7]->value }}</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="books-sliders-info">
                        <div class="book-slides owl-carousel owl-theme">
                            @foreach ($products as $product)
                                <div class="item">
                                    <div class="book-listing">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->product_title }}">
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="item">
                                <div class="book-listing">
                                    <img src="{{ asset('assets/images/book-js333.png') }}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="book-listing">
                                    <img src="{{ asset('assets/images/book-js555.png') }}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="book-listing">
                                    <img src="{{ asset('assets/images/book-js444.png') }}" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="book-listing">
                                    <img src="{{ asset('assets/images/book-js666.png') }}" alt="">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-author">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ $sections[10]->value }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{ $sections[8]->value }}</h2>
                        {!! $sections[9]->value !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-books">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="mybooks">
                        <h2>{{ $sections[11]->value }}</h2>
                        {!! $sections[12]->value !!}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mybookslider">
                        <div class="mybooks-carousel owl-carousel owl-theme">
                            @foreach ($product2 as $product)
                                <div class="item">
                                    <div class="main-books-circle">
                                        <div class="client-book-img">
                                            <img src="{{ asset($product->image) }}" class="img-fluid"
                                                alt="{{ $product->product_title }}">
                                        </div>
                                        <div class="back-cricle">
                                            <img src="{{ asset('assets/images/book1.png') }}" class="img-fluid"
                                                alt="">
                                            <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                                Buy From Amazon
                                                <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="item">
                                <div class="main-books-circle">
                                    <div class="client-book-img">
                                        <img src="{{ asset('assets/images/book-js22.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="back-cricle">
                                        <img src="{{ asset('assets/images/book2.png') }}" class="img-fluid" alt="">
                                        <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                            Buy From Amazon
                                            <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-books-circle">
                                    <div class="client-book-img">
                                        <img src="{{ asset('assets/images/book-js33.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="back-cricle">
                                        <img src="{{ asset('assets/images/book3.png') }}" class="img-fluid"
                                            alt="">
                                        <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                            Buy From Amazon
                                            <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-books-circle">
                                    <div class="client-book-img">
                                        <img src="{{ asset('assets/images/book-js44.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="back-cricle">
                                        <img src="{{ asset('assets/images/book4.png') }}" class="img-fluid"
                                            alt="">
                                        <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                            Buy From Amazon
                                            <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-books-circle">
                                    <div class="client-book-img">
                                        <img src="{{ asset('assets/images/book-js55.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="back-cricle">
                                        <img src="{{ asset('assets/images/book5.png') }}" class="img-fluid"
                                            alt="">
                                        <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                            Buy From Amazon
                                            <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="main-books-circle">
                                    <div class="client-book-img">
                                        <img src="{{ asset('assets/images/book-js66.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="back-cricle">
                                        <img src="{{ asset('assets/images/book6.png') }}" class="img-fluid"
                                            alt="">
                                        <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                            Buy From Amazon
                                            <img src="{{ asset('assets/images/amazon.png') }}" class="img-fluid"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="client-review">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-banner">
                        <h2>
                            {{ $sections[14]->value }}
                        </h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="reviews-show">
                        <div class="reviews-carousel owl-carousel owl-theme">
                            <div class="item">
                                <div class="client-testimonial">
                                    <div class="client-para">
                                        <img src="{{ asset('assets/images/qoute.png') }}" class="img-fluid" alt="">
                                        <p>The Mackenzie Green series hooked me from page one. JS Kennedy blends
                                            adventure, suspense, and emotional depth perfectly. The relationships feel
                                            authentic, the pacing is spot-on, and Mackenzie is a heroine who stays true
                                            to herself no matter what.</p>
                                        <div class="review-star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="client-profile-img">
                                        <img src="{{ asset('assets/images/client-img2.png') }}" class="img-fluid"
                                            alt="">
                                        <h5>
                                            Emily R
                                            <span class="d-block">Reader</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-testimonial">
                                    <div class="client-para">
                                        <img src="{{ asset('assets/images/qoute.png') }}" class="img-fluid"
                                            alt="">
                                        <p>Finally, a fantasy series with a strong female lead who doesn’t lose herself
                                            when romance appears. Kennedy’s world-building is rich and immersive, and
                                            the characters feel so real. Every book left me eager for the next. Highly
                                            recommend to anyone who loves magic, danger, and loyalty.</p>
                                        <div class="review-star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="client-profile-img">
                                        <img src="{{ asset('assets/images/client-img1.png') }}" class="img-fluid"
                                            alt="">
                                        <h5>
                                            David K.
                                            <span class="d-block">Reader</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-testimonial">
                                    <div class="client-para">
                                        <img src="{{ asset('assets/images/qoute.png') }}" class="img-fluid"
                                            alt="">
                                        <p>JS Kennedy’s storytelling is addictive. Mackenzie Green is the kind of
                                            heroine you root for—fierce, flawed, and unforgettable. I stayed up all
                                            night finishing the first book and immediately bought the next. This series
                                            has everything: action, heart, and a world you want to live in.</p>
                                        <div class="review-star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="client-profile-img">
                                        <img src="{{ asset('assets/images/client-img3.png') }}" class="img-fluid"
                                            alt="">
                                        <h5>
                                            Samantha L.
                                            <span class="d-block">Reader</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blogs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-article">
                        <h2>{{ $sections[15]->value }}</h2>
                    </div>
                </div>
                @php
                    $blog = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 36)->get();
                @endphp
                <div class="col-lg-4">
                    <div class="blog-article-build">
                        <a href="#">
                            <div class="blog-img">
                                <img src="{{ $blog[0]->value }}" class="img-fluid" alt="">
                            </div>
                        </a>
                        <div class="blog-content">
                            <div class="blog-review">
                                <span>
                                    <i class="fa-regular fa-folder-open"></i>
                                    Blog
                                </span>
                                <h6>
                                    15
                                    <span class="d-block">
                                        Aug
                                    </span>
                                </h6>
                            </div>
                            {!! $blog[3]->value !!}
                            <a class="btn btn-black">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-article-build">
                        <a href="#">
                            <div class="blog-img">
                                <img src="{{ $blog[1]->value }}" class="img-fluid" alt="">
                            </div>
                        </a>
                        <div class="blog-content">
                            <div class="blog-review">
                                <span>
                                    <i class="fa-regular fa-folder-open"></i>
                                    Blog
                                </span>
                                <h6>
                                    15
                                    <span class="d-block">
                                        Aug
                                    </span>
                                </h6>
                            </div>
                            {!! $blog[4]->value !!}
                            <a class="btn btn-black">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-article-build">
                        <a href="#">
                            <div class="blog-img">
                                <img src="{{ $blog[2]->value }}" class="img-fluid" alt="">
                            </div>
                        </a>
                        <div class="blog-content">
                            <div class="blog-review">
                                <span>
                                    <i class="fa-regular fa-folder-open"></i>
                                    Blog
                                </span>
                                <h6>
                                    15
                                    <span class="d-block">
                                        Aug
                                    </span>
                                </h6>
                            </div>
                            {!! $blog[5]->value !!}
                            <a class="btn btn-black">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="#" class="btn green-btn">
                            View More
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection
