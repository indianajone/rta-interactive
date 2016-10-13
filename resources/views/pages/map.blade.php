@extends('layouts.master')

@section('content')
    
    <div class="map-wrapper">
        <interactive-map inline-template 
            :things="{{ $options }}"
            :place="{{ $place or '{}' }}"
            :nears="{{ $nearby }}"
            :nearby="true"
        >
            <div class="interactive-map">
                @include('components.interactive-map')
                <google-map :route="route" :things="selectedThings"></google-map>
            </div>
        </interactive-map>
    </div>

@stop