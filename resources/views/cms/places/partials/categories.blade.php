@inject('categories', 'Ravarin\Entities\Category')

<div class="col-md-8">
    <div class="form-group">
        {!! Form::label('longitude', 'กลุ่มสถานที่') !!}
        {!! Form::select(
                'categories[]',
                $categories->listGroupWithChildren(), 
                isset($place) ? $place->categories->lists('id')->all() : old('categories'),
                ['class' => 'form-control select2', 'data-placeholder' => 'กรุณาเลือกกลุ่มสถานที่', 'multiple']
        ) !!}
    </div>
</div>