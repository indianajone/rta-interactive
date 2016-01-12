<div class="card">
   <div class="card__image">
        <a href="{{ place_path($place) }}">
            <img src="{{ asset($place->thumbnail) }}" alt="{{ $place->title }}">
        </a>
   </div>
   <div class="card__details">
        <h3 class="card__title">
            <a href="{{ place_path($place) }}">{{ $place->title }}</a>
        </h3>
        <p class="card__excerpt">{{ $place->excerpt }}</p>
   </div>
   <div class="card__buttons">
        <a href="#"><i class="fa fa-lg fa-car"></i></a>
        <a href="{{ place_path($place) }}"><i class="fa fa-lg fa-info"></i></a>
        <a href="#"><i class="fa fa-lg fa-star-o"></i></a>
        <a href="#"><i class="fa fa-lg fa-share-alt"></i></a>
    </div>
</div>