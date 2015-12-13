@extends('layouts.master')

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($places->first()->photos as $photo)
            <div class="item">
                <img class="img-responsive center-block" src="{{ $photo->path }}" alt="">
                <span>{{ $places->first()->name }}</span>
            </div>
        @endforeach
    </div>
@stop

@section('content')
    <h2 class="heading--fancy">สถานที่ท่องเที่ยวแนะนำ</h2>
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