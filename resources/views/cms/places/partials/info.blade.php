@inject('provinces', 'Ravarin\Entities\Province')

<div class="col-md-8">   
    <div class="form-group">
        {!! Form::label('name', 'ชื่อสถานที่') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อสถานที่']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('excerpt', 'คำบรรยาย (แบบย่อ)') !!}
        {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'คำบรรยาย (แบบย่อ)']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'คำบรรยาย') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'คำบรรยาย']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('street', 'ที่อยู่') !!}
        {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'ที่อยู่']) !!}
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('subdistrict', 'แขวง') !!}
                {!! Form::text('subdistrict', null, ['class' => 'form-control', 'placeholder' => 'แขวง']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('district', 'เขต') !!}
                {!! Form::text('district', null, ['class' => 'form-control', 'placeholder' => 'เขต']) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('province', 'จังหวัด') !!}
                {!! Form::select('province', $provinces->th(), null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('postcode', 'รหัสไปรษณีย์') !!}
                {!! Form::text('postcode', null, ['class' => 'form-control', 'placeholder' => 'รหัสไปรษณีย์']) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="latitude">ละติจูด</label>
                {!! Form::label('latitude', 'ละติจูด') !!}
                {!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => 'ละติจูด']) !!}
            </div>
            <div class="col-md-6">
                {!! Form::label('longitude', 'ลองจิจูด') !!}
                {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => 'ลองจิจูด']) !!}
            </div>
        </div>
    </div>
</div>