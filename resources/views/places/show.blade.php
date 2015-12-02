@extends('layouts/master')

@section('banner')
    <slideshow type="banner"></slideshow>
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
                <slideshow 
                    type="slideshow" 
                    :options="{ contain: true }"
                ></slideshow>
                
            </div>
        @endif
        <div class="row">
            @if($place->video)
                <div class="place__vdo">
                    <h3 class="heading--fancy">วีดีโอ</h3>
                    <div class="place__image">
                        <a  href="#"
                            @click.prevent="showModal = true"
                        >
                            <img src="{{ asset($place->video->thumbnail) }}" alt="{{ $place->video->title }}">
                            <div class="place__overlay">
                                <i class="fa fa-play-circle-o"></i>
                            </div>
                        </a>
                        <modal v-if="showModal" :open.sync="showModal">
                            <div class="modal-video" slot="body">
                                {!! $place->video->src !!}
                            </div>
                        </modal>
                    </div>
                </div>
            @endif
            @if($place->ar)
                <div class="place__mini-map">
                    <h3 class="heading--fancy">แผนที่</h3>
                    <div class="place__image">
                        <img src="/images/default.jpg" alt="{{ $place->name }}">
                    </div>
                </div>
            @endif
            @if($place->panorama)
                <div class="place__panorama">
                    <h3 class="heading--fancy">พาโนราม่า</h3>
                    <div class="place__image">
                        <a href="#" @click.prevent="showModal = true">
                            <img src="{{ asset($place->panorama->thumbnail_path) }}" alt="{{ $place->name }}-panorama">
                        </a>
                    </div>
                    <modal v-if="showModal" :open.sync="showModal">
                        <div class="modal-panorama" slot="body">
                            <panorama src="{{ asset($place->panorama->path) }}"></panorama>
                        </div>
                    </modal>
                </div>
            @endif
        </div>
    </div>
@stop