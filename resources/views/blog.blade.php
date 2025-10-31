@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 36)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 36)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp
@extends('layouts.app')
@section('title', 'Home')

@section('css')
@endsection

@section('content')



    <section class="hm-banner inner-banners" id="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="main-book-sldier">
                        <div class="inner-banner-heading">
                            <h1>{{ $page->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blogs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="blog-article inner-blog-article">
                        {!! $page->content !!}
                    </div>
                </div>
                @foreach ($blogs as $blog)
                    @php
                        $date = !empty($blog->event_datetime)
                            ? \Carbon\Carbon::parse($blog->event_datetime)
                            : \Carbon\Carbon::parse($blog->created_at);
                    @endphp

                    <div class="col-lg-4 col-md-4 col-12">
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
                                        {{ $date->format('d') }}
                                        <span class="d-block">
                                            {{ $date->format('M') }}
                                        </span>
                                    </h6>
                                </div>
                                <h4>{!! $blog->short_detail !!}</h4>
                                <p>{!! $blog->detail !!}</p>
                                <a href="{{ route('blogdetail', $blog->id) }}" class="btn btn-black">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>



@endsection

@section('js')
@endsection
