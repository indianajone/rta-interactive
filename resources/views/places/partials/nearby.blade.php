@if($place->nearby->count()) 
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.nearby') }}</h3>
        <div class="cards row">
            @foreach($place->nearby->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $place)
                        <div class="card">
                            <div class="card__image">
                                <img src="{{ $place->thumbnail }}" alt="{{ $place->title }}">
                            </div>
                            <div class="card__details">
                                <h3 class="card__title">{{ $place->title }}</h3>
                            </div>
                            <div class="card__buttons">
                                <p>
                                    <i class="fa fa-lg fa-phone"></i>
                                    {{ $place->tel }}
                                </p>
                                <a href="#"><i class="fa fa-lg fa-map-marker"></i></a>
                                <a href="#"><i class="fa fa-lg fa-car"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif