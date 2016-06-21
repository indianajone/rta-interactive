@if($place->photos->count())
    <div class="place__photos">
        <h3 class="heading--fancy">{{ trans('common.heading.photo') }}</h3>
        <readmore 
            max-height="300" 
            text="{{ collect(trans('common.buttons.viewall')) }}"
            show="{{ $place->photos->count() > 3 }}"
        >
            <gallery 
                photos="{{ $place->photos }}"
                buttons="{{ collect(trans('common.buttons.viewall')) }}"
            >
            </gallery>
        </readmore>
    </div>
@endif