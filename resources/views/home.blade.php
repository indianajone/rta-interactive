@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($slideshow as $item)
            <div class="slick-slide slick-slide--fixed-height">
                <img src="{{ asset($item->path) }}" alt="$item->title">
                <span>{{ $item->title }}</span>
            </div>
        @endforeach
    </div>
@stop

@section('content')
    @include('components/ceo')
    <h2 class="heading--fancy">สถานที่ท่องเที่ยวยอดนิยม</h2>
    <div class="cards">
        @forelse($places->chunk(3) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
        @empty
            <div class="notfound">
                <h3 class="notfound__body">ไม่พบข้อมูล</h3>
            </div>
        @endforelse 
    </div>
@stop