@extends('layouts/master')

@section('content')
    
    <place-filter inline-template :open-modal="openModal" :places="{{ $places }}">
        <div class="place-filter" v-cloak>
            <div class="filter">
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
            
            <h2 class="heading--fancy">{{ trans('common.heading.places') }}</h2>
            
            <div class="cards">
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
                            <p class="card__excerpt">@{{ place.excerpt }}</p>
                        </div>
                        <div class="card__buttons">
                            <div class="card__button">
                                <a href="@{{ place.map_url }}"><i class="fa fa-lg fa-car"></i></a>
                            </div>
                            <div class="card__button">
                                <a href="@{{ place.url }}"><i class="fa fa-lg fa-info"></i></a>
                            </div>
                            <div class="card__button">
                                @if(!Auth::check())
                                    <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-star-o"></i></a>
                                @else
                                    <favorite-button place="@{{ place.id }}" favorited="@{{ place.favorited }}"></favorite-button>
                                @endif
                            </div>
                            <div class="card__button">
                                @if(!Auth::check())
                                    <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-share-alt"></i></a>
                                @else
                                    <social-share url="@{{ place.url }}"></social-share>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </place-filter>
@stop