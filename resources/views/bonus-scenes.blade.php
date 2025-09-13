@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 35)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 35)->get();
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
                        <h1>{{$page->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bonus-scenes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="beta-version">
                    <h2>{{ $sections[0]->value }}<span class="d-block">Version</span></h2>
                    {!! $page->content !!}
                </div>
                <div class="bonus-scene-version">
                    <div class="santa-version">
                        <a href="#" class="btn snata-btn">Secret Santa <img src="{{asset("asset/images/btn-arrow.png")}}" class="img-fluid"
                                alt=""></a>
                        <p>Book 3 – Curious as to who got whom in the
                            Green family Secret Santa. Click to find out!</p>
                    </div>
                    <div class="santa-version">
                        <a href="#" class="btn snata-btn">New Arrivals <img src="{{asset("asset/images/btn-arrow.png")}}" class="img-fluid"
                                alt=""></a>
                        <p>Book 3 – Interested in the first meeting of
                            Quinn, Alec, and the kids. Well, here it is.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
@endsection