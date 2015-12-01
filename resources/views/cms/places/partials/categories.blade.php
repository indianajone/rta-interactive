@inject('categories', 'Ravarin\Entities\Category')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">หมวด</h3>
    </div>
    <div class="panel-body">
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
    </div>
</div>