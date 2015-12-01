<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">พิกัด</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
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
</div>