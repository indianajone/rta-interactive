@inject('categories', 'Ravarin\Entities\Category')
<div class="form-group">
    {!! Form::select(
            'categories[]',
            $categories->listGroupWithChildren(), 
            isset($place) ? 
                $place->categories->lists('id')->all() : 
                old('categories'),
            [
                'data-placeholder' => 'กรุณาเลือกกลุ่มสถานที่', 
                'class' => 'form-control select2',
                'style' => 'width: 100%',
                'multiple'
            ]
    ) !!}
</div>