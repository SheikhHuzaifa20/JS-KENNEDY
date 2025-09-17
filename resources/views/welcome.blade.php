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
                                                        <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid"
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
                                                                    <a href="JavaScript:;" id="show" class="main-text-1">
                                                                        <img src="{{ asset($product->image) }}"
                                                                            class="img-fluid" alt="" data-atropos-offset="2">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="back-circle">
            <img src="{{ asset('asset/images/banner-circle.png') }}" class="img-fluid" alt="">
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
                                            <img src="{{ asset('asset/images/book1.png') }}" class="img-fluid" alt="">
                                            <a href="{{ $sections[13]->value }}" class="btn btn-black">
                                                Buy From Amazon
                                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="client-testimonial">
                                        <div class="client-para">
                                            <img src="{{ asset('asset/images/qoute.png') }}" class="img-fluid" alt="">
                                            <p>{!! $testimonial->comments !!}</p>
                                            <div class="review-star">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $testimonial->stars)
                                                        <i class="fa-solid fa-star text-warning"></i> {{-- filled star --}}
                                                    @else
                                                        <i class="fa-regular fa-star text-muted"></i> {{-- empty star --}}
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="client-profile-img">
                                            <img src="{{ $testimonial->image }}" class="img-fluid" alt="">
                                            <h5>
                                                {{ $testimonial->name }}
                                                <span class="d-block">{{ $testimonial->designation }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

                @foreach ($blogs as $blog)
                    <div class="col-lg-4">
                        <div class="blog-article-build">
                            <a href="#">
                                <div class="blog-img">
                                    <img src="{{ $blog->image }}" class="img-fluid" alt="">
                                </div>
                            </a>
                            <div class="blog-content">
                                <div class="blog-review">
                                    <span>
                                        <i class="fa-regular fa-folder-open"></i>
                                        {{ $blog->name }}
                                    </span>
                                    <h6>
                                        15
                                        <span class="d-block">
                                            Aug
                                        </span>
                                    </h6>
                                </div>
                                {!! $blog->short_detail !!}
                                {!! $blog->detail !!}
                                <a href="{{ route('blogdetail', $blog->id) }}" target="_blank" class="btn btn-black">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
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