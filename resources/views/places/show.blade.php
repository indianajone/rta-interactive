@extends('layouts/master')

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
    @include('places.partials.panorama')
    @include('places.partials.marker')
    @include('places.partials.nearby')
@stop