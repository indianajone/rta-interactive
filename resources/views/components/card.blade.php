<div class="card">
   <div class="card__image">
       <a href="{{ route('place_path', str_replace(' ', '-', $place->name)) }}">
            <img src="{{ asset($place->thumbnail) }}" alt="{{ $place->name }}">
       </a>
   </div>
   <div class="card__details">
        <h3 class="card__title">
            <a href="{{ route('place_path', str_replace(' ', '-', $place->name)) }}">{{ $place->name }}</a>
        </h3>
        <p class="card__excerpt">{{ $place->excerpt }}</p>
   </div>
   <div class="card__buttons">
       <a href="#"><i class="fa fa-lg fa-car"></i></a>
       <a href="#"><i class="fa fa-lg fa-info"></i></a>
       <a href="#"><i class="fa fa-lg fa-star-o"></i></a>
       <a href="#"><i class="fa fa-lg fa-share-alt"></i></a>
   </div>
</div>