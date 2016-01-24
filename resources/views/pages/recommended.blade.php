@extends('layouts.master')

@section('banner')
    @if($places->count())
        <div class="slick slick--black" v-slick>
            @foreach($places->first()->photos as $photo)
                 <div class="slick-slide slick-slide--fixed-height">
                    <img src="{{ asset($photo->path) }}" alt="">
                    <span>{{ $places->first()->name }}</span>
                </div>
            @endforeach
        </div>
    @endif
@stop

@section('content')
    <h2 class="heading--fancy">{{ trans('common.heading.recommended') }}</h2>
    <div class="cards">
        @forelse($places->chunk(3) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
        @empty
            <div class="notfound">
                <h3 class="notfound__body">{{ trans('common.notfound') }}</h3>
            </div>
        @endforelse 
    </div>
@stop