@extends('layouts/master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($place->photos as $photo)
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
            <a href="#"><i class="fa fa-lg fa-car"></i></a>
            <a href="#"><i class="fa fa-lg fa-star-o"></i></a>
            <a href="#"><i class="fa fa-lg fa-share-alt"></i></a>
        </div>
        
        <readmore 
            class="place__body"
            max-height="160" 
            text="{{ trans('common.buttons.readmore') }}"
            show="true"
        >
            {!! $place->description !!}
        </readmore>
    </div>
    
    @include('places.partials.photo')

    @include('places.partials.video')
        {{-- <div class="row">
            @if($place->video)
                <div class="place__vdo">
                    <h3 class="heading--fancy">วีดีโอ</h3>
                    <div class="place__image">
                        <a href="{{ $place->video->src }}" data-lity>
                            <img src="{{ asset($place->video->thumbnail) }}" alt="{{ $place->video->title }}">
                            <div class="place__overlay">
                                <i class="fa fa-play-circle-o"></i>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if($place->ar)
                <div class="place__mini-map">
                    <h3 class="heading--fancy">แผนที่</h3>
                    <div class="place__image">
                        <img src="/images/default.jpg" alt="{{ $place->title }}">
                    </div>
                </div>
            @endif
            @if($place->panorama)
                <div class="place__panorama">
                    <h3 class="heading--fancy">พาโนราม่า</h3>
                    <div class="place__image">
                        <a href="#panorama" data-lity>
                            <img src="{{ asset($place->panorama->thumbnail_path) }}" alt="{{ $place->title }}-panorama">
                        </a>
                    </div>
                    <panorama src="{{ asset($place->panorama->path) }}"></panorama>
                </div>
            @endif
        </div> --}}
@stop