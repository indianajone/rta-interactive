@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">ผู้ดูแลระบบ</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('components.error')
            {!! Form::open([
                'method' => 'POST',
                'route' => ['cms.admin.store']
            ]) !!}
                
                <div class="form-group">
                    {!! Form::label('name', 'ชื่อ') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อ']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'อีเมลล์') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'อีเมลล์']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'รหัสใข้งาน') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'รหัสใข้งาน']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'ยืนยันรหัสใข้งาน') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'ยืนยันรหัสใข้งาน']) !!}
                </div>

                <div class="pull-right">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop