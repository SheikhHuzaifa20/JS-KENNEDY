@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 38)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 38)->get();
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
                            <h1>{{ $page->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="about-author books-pg-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book1->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book1->product_title}}</h2>
                        {!! $book1->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book1->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-author books-pg-inner books-back-dark">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book2->product_title}}</h2>
                        {!! $book2->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book2->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                            <a href="#" class="btn snata-btn">Audiobook</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book2->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="about-author books-pg-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book3->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book3->product_title}}</h2>
                        {!! $book3->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book3->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                            <a href="#" class="btn snata-btn">Audiobook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-author books-pg-inner books-back-dark">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book4->product_title}}</h2>
                        {!! $book4->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book4->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                            <a href="#" class="btn snata-btn">Audiobook</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book4->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-author books-pg-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book5->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book5->product_title}}</h2>
                        {!! $book5->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book5->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                            <a href="#" class="btn snata-btn">Audiobook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="about-author books-pg-inner books-back-dark">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="author-about">
                        <h2>{{$book6->product_title}}</h2>
                        {!! $book6->description !!}
                        <div class="book-links-snata">
                            <a href="{{$book6->link}}" class="btn snata-btn"> Buy From Amazon
                                <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt=""></a>
                            <a href="#" class="btn snata-btn">Audiobook</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="client-img-banner">
                        <img src="{{ asset($book6->images) }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="redemption-freedom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="redemption-quest">
                        {!! $sections[1]->value !!}
                    </div>
                    <div class="book-footer-banner">
                        <img src="{{$sections[2]->value}}" class="img-fluid"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('js')
@endsection