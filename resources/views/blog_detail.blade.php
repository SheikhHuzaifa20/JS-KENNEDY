@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 36)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 36)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp

@extends('layouts.app')
@section('title', 'Home')

@section('css')
    <style>
        .card {
            max-width: 800px;
            margin: 20px auto;
        }

        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            padding: 20px;
        }

        .card img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 15px;
            line-height: 1.7;
            color: #222;
            margin-bottom: 15px;
        }

        .card p:last-child {
            margin-bottom: 0;
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
                            <h1>{{ $page->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-detail">
        <div class="container">
            <div class="card">
                <!-- Image -->
        {{-- @dd($blog->image) --}}

                <img src="{{ asset($blog->image) }}" alt="Fantasy">

                <!-- Content -->
                {!! $blog->inner_detail !!}
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
