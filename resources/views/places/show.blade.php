@extends('layouts/master')

@section('banner')
    <div class="banner">
        <img src="/uploaded/2015/11/09/bangpu.jpg" alt="bangpu">
    </div>
@stop

@section('content')
    <h2 class="heading--fancy">{{ $place->name }}</h2>
    <div class="place">
        <div class="place__buttons">
            <a href="#"><i class="fa fa-lg fa-car"></i></a>
            <a href="#"><i class="fa fa-lg fa-info"></i></a>
            <a href="#"><i class="fa fa-lg fa-star-o"></i></a>
            <a href="#"><i class="fa fa-lg fa-share-alt"></i></a>
        </div>
        <div class="place__body">
            {{ $place->description }}
        </div>
        @if($place->photos->count() >= 1 )
            <div class="place__photos">
                <h3 class="heading--fancy">คลังภาพ</h3>
                @foreach($place->photos as $photo)
                    <div class="place__image">
                        <img src="{{ $photo->thumbnail_path }}" alt="{{ $photo->name }}">
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            {{-- @if($place->video) --}}
                <div class="place__vdo">
                    <h3 class="heading--fancy">วีดีโอ</h3>
                    <div class="place__image">
                        <img src="/images/default.jpg" alt="{{ $place->name }}">
                    </div>
                </div>
            {{-- @endif --}}
            <div class="place__mini-map">
                <h3 class="heading--fancy">แผนที่</h3>
                <div class="place__image">
                    <img src="/images/default.jpg" alt="{{ $place->name }}">
                </div>
            </div>
            <div class="place__panorama">
                <h3 class="heading--fancy">พาโนราม่า</h3>
                <div class="place__image">
                    <img src="/images/default.jpg" alt="{{ $place->name }}">
                </div>
            </div>
        </div>
    </div>
@stop