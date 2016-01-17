@if($place->markers->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.marker') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ trans('common.buttons.viewall') }}" 
            show="{{ $place->markers->count() > 3 }}"
        >
             @foreach($place->markers->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $marker)
                        <div class="place__image">
                             <a href="{{ asset($marker->path) }}" data-lity>
                                <img src="{{ asset($marker->thumbnail_path) }}" alt="{{ $marker->title }}">
                                <h4 class="text-center">{{ $marker->title }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </readmore>
    </div>
@endif