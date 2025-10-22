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



    @foreach ($books as $index => $book)
        @php $isGreen = $index % 2 !== 0; @endphp

        <section class="about-author books-pg-inner {{ $isGreen ? 'books-back-dark' : '' }}">
            <div class="container">
                <div class="row align-items-center">
                    @if(!$isGreen)
                        {{-- White section --}}
                        <div class="col-lg-6 col-,d-6 col-12">
                            <div class="client-img-banner">
                                <img src="{{ asset($book->image) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-,d-6 col-12">
                            <div class="author-about">
                                <h2>{{ $book->product_title }}</h2>
                                {!! $book->description !!}
                                <div class="book-links-snata">
                                    <a href="{{ $book->link }}" class="btn snata-btn" target="_blank">
                                        Buy From Amazon
                                        <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt="">
                                    </a>
                                    <a href="{{ $book->audiolink }}" target="_blank" class="btn snata-btn">Audiobook</a>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Green section --}}
                        <div class="col-lg-6 col-,d-6 col-12">
                            <div class="author-about text-white">
                                <h2>{{ $book->product_title }}</h2>
                                {!! $book->description !!}
                                <div class="book-links-snata">
                                    <a href="{{ $book->link }}" class="btn snata-btn" target="_blank">
                                        Buy From Amazon
                                        <img src="{{ asset('asset/images/amazon.png') }}" class="img-fluid" alt="">
                                    </a>
                                    <a href="{{ $book->audiolink }}" target="_blank" class="btn snata-btn">Audiobook</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-,d-6 col-12">
                            <div class="client-img-banner">
                                <img src="{{ asset($book->image) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

    <section class="redemption-freedom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 p-0">
                    <div class="redemption-quest">
                        {!! $page->content !!}
                    </div>
                    <div class="book-footer-banner">
                        <img src="{{$page->image}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('js')
@endsection