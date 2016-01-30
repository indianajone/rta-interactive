@extends('layouts.master')

@section('content')
    <h2 class="heading--fancy">{{ trans('common.heading.favorites') }}</h2>
    @if($user->favoritePlaces->count())
        <div class="cards">
            @foreach($user->favoritePlaces as $place)
                @include('components.card')
            @endforeach
        </div>
    @else
        <div class="notfound">
            <h3 class="notfound__body">{{ trans('common.notfound') }}</h3>
        </div>
    @endif
@stop