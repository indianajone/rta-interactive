@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">ผู้อำนวยการ</h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('components.error')
            {!! Form::open() !!}
                <div class="form-group">
                    {!! Form::label('name', 'ชื่อ') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('position', 'ตำแหน่ง') !!}
                    {!! Form::text('position', null, ['class' => 'form-control', 'placeholder' => 'ตำแหน่ง']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo', 'รูป') !!}
                    {!! Form::file('photo', ['class' => 'form-control', 'placeholder' => 'รูป']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'คำบรรยาย') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'คำบรรยาย']) !!}
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                </div>
            {!! Form::close(); !!}
        </div>
    </div>
@stop