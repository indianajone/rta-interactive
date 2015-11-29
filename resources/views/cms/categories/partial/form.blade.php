@inject('categories', 'Ravarin\Entities\Category')

<div class="col-md-8">   
    <div class="form-group">
        {!! Form::label('name', 'ชื่อ') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อ']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('parent_id', 'เป็นหมวดหมู่ย่อยของ') !!}
        {!! Form::select(
            'parent_id', 
            $categories->listGroups(), 
            null,
            [
                'class' => 'form-control select2',
                'placeholder' => 'ไม่มี'
            ]
        ) !!}
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
    </div>
</div>