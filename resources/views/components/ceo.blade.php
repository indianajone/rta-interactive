@inject('ceo', 'Ravarin\Entities\Ceo')
<div class="ceo">
    <div class="ceo__image">
        <img src="{{ asset($ceo->image->path) }}" alt="{{ $ceo->image->title }}">
    </div>
    <div class="ceo__body">
        <h3 class="ceo__body__name">
            {{ $ceo->name }}
            <span class="ceo__body__position">{{ $ceo->position }}</span>
        </h3>
        <p class="ceo__body__description">
           {{ $ceo->description }}
        </p>   
    </div>
</div>