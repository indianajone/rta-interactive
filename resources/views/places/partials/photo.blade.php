@if($place->photos->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.photo') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ trans('common.buttons.viewall') }}" 
            show="{{ $place->photos->count() > 3 }}"
        >
             @foreach($place->photos->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $photo)     
                        <div class="place__image">
                            <a href="{{ asset($photo->path) }}" data-lity>
                                <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                                <h4 class="text-center">{{ $photo->title }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </readmore>
    </div>
@endif