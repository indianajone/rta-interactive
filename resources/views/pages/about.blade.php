@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($page->slides as $item)
            <div class="slick-slide">
                <img src="{{ asset($item->path) }}" alt="{{ $item->title }}">
            </div>
        @endforeach
    </div>
@stop

@section('content')
    @include('components.ceo')
    <h2 class="heading--fancy">{{ $page->title }}</h2>
    <div class="about">
        {!! $page->body !!}
    </div>
@stop