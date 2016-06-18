@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($slideshow as $item)
            <div class="slick-slide slick-slide--fixed-height">
                <div class="slide-item">
                    <img class="slide-item__image" src="{{ asset($item->path) }}" alt="{{ $item->title }}">
                    @if ($item->title)
                        <span class="slide-item__title">{{ $item->title }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('content')
    @include('components/ceo')
    <h2 class="heading--fancy">{{ trans('common.heading.populars') }}</h2>
    <div class="cards">
        @forelse($places->chunk(3) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
            <div class="bottom-buttons">
                <a class="btn btn-main" href="{{ route('places_path', ['lang' => session()->get('locale')]) }}">
                    {{ trans('common.buttons.viewall')[0] }}
                </a>
            </div>
        @empty
            <div class="notfound">
                <h3 class="notfound__body">{{ trans('common.notfound') }}</h3>
            </div>
        @endforelse 
    </div>
@stop