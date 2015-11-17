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
        @foreach($places->chunk(3) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
        @endforeach
         @foreach($places->chunk(3) as $set)
            <div class="row">
                @foreach($set as $place)
                    @include('components/card')
                @endforeach
            </div>
        @endforeach
    </div>
@stop