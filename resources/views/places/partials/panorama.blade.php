@if($place->panoramas->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.panorama') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ trans('common.buttons.viewall') }}" 
            show="{{ $place->panoramas->count() > 3 }}"
        >
             @foreach($place->panoramas->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $panorama)
                        <div class="place__image">
                            <a href="#panorama" data-lity>
                                <img src="{{ asset($panorama->thumbnail_path) }}" alt="{{ $panorama->title }}">
                                <h4 class="text-center">{{ $panorama->title }}</h4>
                            </a>
                        </div>
                        <panorama src="{{ asset($panorama->path) }}"></panorama>
                    @endforeach
                </div>
            @endforeach
        </readmore>
    </div>
@endif