@if($place->videos->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.video') }}</h3>
        <readmore 
            max-height="230" 
            text="{{ trans('common.buttons.viewall') }}" 
            show="{{ $place->videos->count() > 1 }}"
        >
             @foreach($place->videos->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="place__image">
                            <a href="{{ asset($photo->path) }}" data-lity>
                                <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                                <div class="place__overlay">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </readmore>
    </div>
@endif

{{-- <div class="place__vdo">
    <h3 class="heading--fancy">วีดีโอ</h3>
    <div class="place__image">
        <a href="{{ $place->video->src }}" data-lity>
            <img src="{{ asset($place->video->thumbnail) }}" alt="{{ $place->video->title }}">
            <div class="place__overlay">
                <i class="fa fa-play-circle-o"></i>
            </div>
        </a>
    </div>
</div> --}}