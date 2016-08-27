@if($place->markers->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.marker') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ collect(trans('common.buttons.viewall')) }}"
            show="{{ $place->markers->count() > 3 }}"
        >
            <gallery 
                photos="{{ $place->markers }}"
                buttons="{{ collect(trans('common.buttons.viewall')) }}"
            >
            </gallery>
        </readmore>
    </div>
@endif