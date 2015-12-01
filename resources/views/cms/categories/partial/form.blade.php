@inject('categories', 'Ravarin\Entities\Category')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">หมวด</h3>
    </div>
    <div class="panel-body"> 
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
                    'style' => 'width: 100%',
                    'placeholder' => 'ไม่มี',
                ]
            ) !!}
        </div>
        <div class="form-group">
            <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
        </div>
    </div>
</div>