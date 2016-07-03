@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($slideshow as $item)
            <div class="slick-slide slick-slide--fixed-height">
                <img src="{{ asset($item->path) }}" alt="$item->title">
                @if($item->title)
                    <span>{{ $item->title }}</span>
                @endif
            </div>
        @endforeach
    </div>
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
    <div class="text-center">
        {!! $places->render() !!}
    </div>
@stop