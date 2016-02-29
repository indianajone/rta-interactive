@if($place->videos->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.video') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ collect(trans('common.buttons.viewall')) }}" 
            show="{{ $place->videos->count() > 3 }}"
        >
             @foreach($place->videos->chunk(3) as $set)
                <div class="row">
                    @foreach($set as $video)
                        <div class="place__image">
                            <a href="{{ asset($video->path) }}" data-lity>
                                <img src="{{ asset($video->thumbnail_path) }}" alt="{{ $video->title }}">
                                <div class="place__overlay">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <h4 class="text-center">{{ $video->title }}</h4>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </readmore>
    </div>
@endif