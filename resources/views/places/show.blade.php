@extends('layouts/master')

@section('meta')
    {{-- SEO --}}
    <meta name="description" content="{{ $place->excerpt }}">

    {{-- facebook --}}
    <meta property="fb:app_id" content="{{ env('FB_APP_ID') }}">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $place->title }}">
    <meta property="og:image" content="{{ $place->thumbnail }}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="600"/>
    <meta property="og:description" content="{{ $place->excerpt }}">

    {{-- google+ --}}
    <meta itemprop="name" content="{{ $place->title }}">
    <meta itemprop="description" content="{{ $place->excerpt }}">
    <meta itemprop="image" content="{{ $place->thumbnail }}">
@stop

@section('title') {{ $place->title }} @stop

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($place->photos()->orderBy('updated_at')->take(5)->get() as $photo)
            <div class="slick-slide slick-slide--fixed-height">
                <img src="{{ asset($photo->path) }}" alt="{{ $photo->title }}">
                <span>{{ $photo->title }}</span>
            </div>
        @endforeach
    </div>
@stop

@section('content')
    <h2 class="heading--fancy">{{ $place->title }}</h2>
    <div class="place">
        <div class="place__buttons">
            <a href="{{ map_path($place) }}"><i class="fa fa-lg fa-car"></i></a>
             @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-star-o"></i></a>
            @else
                <favorite-button place="{{ $place->id }}" favorited="{{ $place->hasFavoritedByUser(Auth::user()) }}"></favorite-button>
            @endif
            @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-share-alt"></i></a>
            @else
                <social-share url="{{ place_path($place) }}"></social-share>
            @endif
            <span class="place__button">{{ $place->views }}</span>
        </div>
        
        <readmore 
            class="place__body"
            max-height="160" 
            text="{{ trans('common.buttons.readmore') }}"
            show="{{ mb_strlen($place->description, 'UTF-8') >= 1000 }}"
        >
            {!! $place->description !!}
        </readmore>
    </div>
    
    @include('places.partials.photo')
    @include('places.partials.video')
    @include('places.partials.panorama')
    @include('places.partials.marker')
    @include('places.partials.nearby')
@stop