@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">แก้ไขข้อมูลผู้ดูแลระบบ</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('components.error')
            {!! Form::model($user, [
                'method' => 'PUT',
                'route' => ['cms.admin.update', $user->id]
            ]) !!}
                
                <div class="form-group">
                    {!! Form::label('name', 'ชื่อ') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อ']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'อีเมลล์') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'อีเมลล์', 'readonly']) !!}
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