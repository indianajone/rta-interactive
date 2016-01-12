@inject('provinces', 'Ravarin\Entities\Province')

<div class="form-group">
    {!! Form::label("title:$lang", 'ชื่อสถานที่') !!}
    {!! Form::text("title:$lang", null, ['class' => 'form-control', 'placeholder' => 'ชื่อสถานที่']) !!}
</div>

<div class="form-group">
    {!! Form::label("excerpt:$lang", 'คำบรรยาย (แบบย่อ)') !!}
    {!! Form::textarea("excerpt:$lang", null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'คำบรรยาย (แบบย่อ)']) !!}
</div>

<div class="form-group">
    {!! Form::label("description:$lang", 'คำบรรยาย') !!}
    {!! Form::textarea("description:$lang", null, ['class' => 'form-control editor', 'rows' => 5, 'placeholder' => 'คำบรรยาย']) !!}
</div>

<div class="form-group">
    {!! Form::label("street:$lang", 'ที่อยู่') !!}
    {!! Form::text("street:$lang", null, ['class' => 'form-control', 'placeholder' => 'ที่อยู่']) !!}
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            {!! Form::label("subdistrict:$lang", 'แขวง') !!}
            {!! Form::text("subdistrict:$lang", null, ['class' => 'form-control', 'placeholder' => 'แขวง']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label("district:$lang", 'เขต') !!}
            {!! Form::text("district:$lang", null, ['class' => 'form-control', 'placeholder' => 'เขต']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            {!! Form::label("province:$lang", 'จังหวัด') !!}
            {!! Form::select("province:$lang", $provinces->th(), null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label("postcode:$lang", 'รหัสไปรษณีย์') !!}
            {!! Form::text("postcode:$lang", null, ['class' => 'form-control', 'placeholder' => 'รหัสไปรษณีย์']) !!}
        </div>
    </div>
</div>