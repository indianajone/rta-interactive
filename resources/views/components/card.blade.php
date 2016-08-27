<div class="card">
    <div class="card__image">
        <a href="{{ place_path($place) }}">
            <img src="{{ $place->thumbnail }}" alt="{{ $place->title }}">
        </a>
    </div>
    <div class="card__details">
        <h3 class="card__title">
            <a href="{{ place_path($place) }}">{{ $place->title }}</a>
        </h3>
        {{-- <p class="card__excerpt">{{ $place->excerpt }}</p> --}}
    </div>
    <div class="card__buttons">
        <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.to_map') }}">
            <a href="{{ map_path($place) }}"><i class="fa fa-lg fa-car"></i></a>
        </div>
        <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.to_content') }}">
            <a href="{{ place_path($place) }}"><i class="fa fa-lg fa-info"></i></a>
        </div>
        <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.favorite') }}">
            @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-star-o"></i></a>
            @else
                <favorite-button place="{{ $place->id }}" favorited="{{ $place->hasFavoritedByUser(Auth::user()) }}"></favorite-button>
            @endif
        </div>
        <div class="card__button" data-toggle="tooltip" title="{{ trans('common.buttons.share') }}">
            @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-share-alt"></i></a>
            @else
                <social-share url="{{ place_path($place) }}"></social-share>
            @endif
        </div>
    </div>
</div>