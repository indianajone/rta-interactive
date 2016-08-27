@extends('layouts/master')

@section('content')
    
    <place-filter inline-template :open-modal="openModal" :places="{{ $places }}">
        <div class="place-filter" v-cloak>
            
            <h2 class="heading--fancy">
                {{ trans('common.heading.places') }}
            </h2>
            
            <div :class="['cards', { 'show-nav': open }]">
                <div class="row" v-for="chuck in places | inCategory | chunk 3">
                    <div v-for="place in chuck" class="card">
                        <div class="card__image">
                            <a href="@{{ place.url }}">
                                <img :src="place.thumbnail" alt="@{{ place.name }}">
                            </a>
                        </div>
                        <div class="card__details">
                            <h3 class="card__title">
                                <a href="@{{ place.url }}">@{{ place.name }}</a>
                            </h3>
                           {{--  <p class="card__excerpt">@{{ place.excerpt }}</p> --}}
                        </div>
                        <div class="card__buttons">
                            <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.to_map') }}">
                                <a href="@{{ place.map_url }}"><i class="fa fa-lg fa-car"></i></a>
                            </div>
                            <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.to_content') }}">
                                <a href="@{{ place.url }}"><i class="fa fa-lg fa-info"></i></a>
                            </div>
                            <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.favorite') }}">
                                @if(!Auth::check())
                                    <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-star-o"></i></a>
                                @else
                                    <favorite-button :place="place.id" :favorited=" place.favorited"></favorite-button>
                                @endif
                            </div>
                            <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.share') }}">
                                @if(!Auth::check())
                                    <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-share-alt"></i></a>
                                @else
                                    <social-share :url="place.url"></social-share>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="notfound" v-if="noResult">
                <h3 class="notfound__body">{{ trans('common.notfound') }}</h3>
            </div>

            <div :class="['filter', { 'show-nav': open }]">
                <div @click="toggle()" class="filter__button">
                    <i :class="['fa', 'fa-arrow-' + (open ? 'left' : 'right')]"></i>
                </div>
                <div class="filter__heading">
                    <h3 class="filter__heading__title">
                        <i class="fa fa-sliders"></i>
                        <span>{{ trans('common.heading.filter') }}</span>
                    </h3>
                </div>
                <div class="filter__body">
                    @foreach($categories as $category)
                        <div class="filter__category">
                            <h4 class="filter__category__heading">{{ $category->name }}</h4>
                            @foreach($category->children as $child)
                                <div class="checkbox">
                                    <label>
                                        <input 
                                            v-model="filteredBy"
                                            type="checkbox" 
                                            value="{{ $child->id }}"
                                        >
                                        {{ $child->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        
        </div>
    </place-filter>
@stop