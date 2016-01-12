<div class="ceo">
    @if($ceo->image)
        <div class="ceo__image">
            <img src="{{ asset($ceo->image->path) }}" alt="{{ $ceo->image->title }}">
        </div>
    @endif
    <div class="ceo__body">
        <h3 class="ceo__body__name">
            {{ $ceo->fullname }}
            <span class="ceo__body__position">{{ $ceo->position }}</span>
        </h3>
        <p class="ceo__body__description">
           {{ $ceo->description }}
        </p>   
    </div>
</div>