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
    
    <h2 class="heading--fancy">{{ trans('common.heading.ar_code') }}</h2>
    
    <article>
        @if(app()->getLocale() === 'th')
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        @else
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        @endif
    </article>

    <h2 class="heading--fancy">{{ trans('common.heading.recommended') }}</h2>
    
    <div class="cards cards--col-2">
        @forelse($places->chunk(2) as $set)
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