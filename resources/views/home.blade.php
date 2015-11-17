@extends('layouts.master')

@section('banner')
    <div class="banner">
        <img src="uploaded/2015/11/09/bangpu.jpg" alt="bangpu">
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