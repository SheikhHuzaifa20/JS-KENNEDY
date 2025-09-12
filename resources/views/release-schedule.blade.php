@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 34)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 34)->get();
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
                <div class="col-lg-12">
                    <div class="main-book-sldier">
                        <div class="inner-banner-heading">
                            {{-- @dd($page) --}}
                            <h1>{{ $page->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="hm-banner release-shedule-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-book-sldier">
                        <div class="banner-sliders owl-carousel owl-theme">
                            @foreach ($products as $product)
                                <div class="item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-7">
                                            <div class="banner-content">
                                                <h2>
                                                    {{ $page->name }}
                                                </h2>
                                                {!! $sections[0]->value !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
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
                                    <div class="col-lg-7">
                                        <div class="banner-content">
                                            <h2>
                                                {{ $page->name }}
                                            </h2>
                                            {!! $sections[0]->value !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{ asset('assets/images/book-js66.png') }}"
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
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="banner-content">
                                            <h2>
                                                {{ $page->name }}
                                            </h2>
                                            {!! $sections[0]->value !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{ asset('assets/images/book-js44.png') }}"
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
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="banner-content">
                                            <h2>
                                                {{ $page->name }}
                                            </h2>
                                            {!! $sections[0]->value !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{ asset('assets/images/book-js33.png') }}"
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
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="banner-content">
                                            <h2>
                                                {{ $page->name }}
                                            </h2>
                                            {!! $sections[0]->value !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show" class="main-text-1">
                                                                    <img src="{{ asset('assets/images/book-js22.png') }}"
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
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <div class="banner-content">
                                            <h2>
                                                {{ $page->name }}
                                            </h2>
                                            {!! $sections[0]->value !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="banner-books">
                                            <div class="books-wanhu">
                                                <div class="atropos my-atropos">
                                                    <div class="atropos-scale">
                                                        <div class="atropos-rotate">
                                                            <div class="atropos-inner">
                                                                <a href="JavaScript:;" id="show"
                                                                    class="main-text-1">
                                                                    <img src="{{ asset('assets/images/book-js11.png') }}"
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


    <section class="bonus-scenes relence-schedule-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="beta-version">
                        <h2>{{ $sections[1]->value }}</h2>
                        <p>This series is from Mackenzie’s point of view unless otherwise states.</p>
                    </div>
                    <div class="bonus-scene-version">
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Catch and Release <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                            <p>Prequel novella from Curtis’s point of view</p>
                        </div>
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Green Gryphon <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                        </div>
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Green Mage <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="bonus-scene-version">
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Green Shadow <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                            <p>Switches POV between Mackenzie and Lucan</p>
                        </div>
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Green Vampire <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                        </div>
                        <div class="santa-version">
                            <a href="#" class="btn snata-btn">Green Dragon - April 28th, 2025 <img
                                    src="{{ asset('assets/images/btn-arrow.png') }}" class="img-fluid"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('js')
@endsection
