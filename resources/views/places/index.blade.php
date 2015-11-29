@extends('layouts/master')

@section('content')

    <place-filter :places="{{ $places }}" inline-template>
        <div class="place-filter" >
            <form @submit.prevent class="filter">
                <div class="filter__heading">
                    <h3 class="filter__heading__title">
                        <i class="fa fa-sliders"></i>
                        <span>ตัวกรอง</span>
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
            </form>

            <h2 class="heading--fancy">สถานที่ท่องเที่ยวยอดนิยม</h2>

            <div class="cards">
                <div v-for="chuck in places | inCategory | chunk 3" class="row">
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
                    </div>
                </div>
            </div>
        </div>
    </place-filter>
@stop