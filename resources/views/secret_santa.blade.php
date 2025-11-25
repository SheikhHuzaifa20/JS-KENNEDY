@php
    $page = \Illuminate\Support\Facades\DB::table('pages')->where('id', 39)->first();
    $sections = \Illuminate\Support\Facades\DB::table('section')->where('page_id', 39)->get();
    $banners = \Illuminate\Support\Facades\DB::table('banners')->get();
@endphp

@extends('layouts.app')
@section('title', 'Home')

@section('css')
    <style>
        /* Custom styles for the story */
        .story-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
            line-height: 1.7;
            color: #333;
            font-family: 'Georgia', serif;
        }

        .story-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #1a472a;
            border-bottom: 2px solid #2e8b57;
            padding-bottom: 1rem;
        }

        .story-chapter {
            margin-bottom: 3rem;
        }

        .chapter-title {
            color: #2e8b57;
            border-left: 4px solid #2e8b57;
            padding-left: 1rem;
            margin: 2rem 0 1rem 0;
        }

        .story-text {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .story-text p {
            margin-bottom: 1rem;
        }

        .story-text em {
            font-style: italic;
        }

        .story-text strong {
            font-weight: bold;
        }

        .story-character {
            font-weight: bold;
            color: #1a472a;
        }

        .story-dialogue {
            margin-left: 2rem;
            font-style: italic;
        }

        .story-thought {
            margin-left: 1.5rem;
            font-style: italic;
            color: #555;
        }

        .story-ending {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #ddd;
            font-style: italic;
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <section class="hm-banner inner-banners" id="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="main-book-sldier">
                        <div class="inner-banner-heading">
                            <h1>{{ $page->page_name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section>
    <div class="story-container">
        <div class="story-title">
            <h1>{{ $page->page_name }}</h1>
            <p>{{ $page->name }}</p>
        </div>
        
        {!! $page->content !!}
    </div>
</section>



@endsection

@section('js')
@endsection
