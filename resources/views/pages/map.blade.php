@extends('layouts.master')

@section('content')

    <interactive-map inline-template 
        :things="{{ $options }}"
        :place="{{ $place or '{}' }}"
        :nears="{{ $nearby }}"
        :nearby="true"
    >
        <div class="interactive-map">
            @include('components.interactive-map')
            <google-panel id="direction"></google-panel>
            <google-map :route="route" :things="selectedThings"></google-map>
        </div>
    </interactive-map>

@stop