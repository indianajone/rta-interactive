@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">ผู้บังคับบัญชา</h1>
    </div>
    <div class="row">
        <div class="col-md-10">
            @include('components.error')
            {!! Form::model($ceo, ['route' => 'cms.ceo_path', 'method' => 'PUT', 'files' => true ]) !!}
            
                    <div class="panel with-nav-tabs">
                        <div class="panel-heading clearfix">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tha" aria-controls="tha" role="tab" data-toggle="tab">ไทย</a>
                                </li>
                                 <li role="presentation">
                                    <a href="#eng" aria-controls="eng" role="tab" data-toggle="tab">อังกฤษ</a>
                                </li>
                            </ul>
                        </div>
                    
                        <div class="panel-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img class="img-circle" src="{{ asset($ceo->image->path) }}" alt="{{ $ceo->image->title }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div class="text-center">
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                {!! Form::file('image', ['class' => 'form-control']) !!}
                                            </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tha">
                                        <div class="form-group">
                                            {!! Form::label('th.name', 'ชื่อนามสกุล') !!}
                                            {!! Form::text('th.name', null , ['class' => 'form-control', 'placeholder' => 'ชื่อนามสกุล']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('th.position', 'ตำแหน่ง') !!}
                                            {!! Form::text('th.position', null, ['class' => 'form-control', 'placeholder' => 'ตำแหน่ง']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('th.description', 'คำบรรยาย') !!}
                                            {!! Form::textarea('th.description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'คำบรรยาย']) !!}
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="eng">
                                        <div class="form-group">
                                            {!! Form::label('en.name', 'ชื่อนามสกุล') !!}
                                            {!! Form::text('en.name', null , ['class' => 'form-control', 'placeholder' => 'ชื่อนามสกุล']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('en.position', 'ตำแหน่ง') !!}
                                            {!! Form::text('en.position', null, ['class' => 'form-control', 'placeholder' => 'ตำแหน่ง']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('en.description', 'คำบรรยาย') !!}
                                            {!! Form::textarea('en.description', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'คำบรรยาย']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-md-offset-3">
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                                </div>
                            </div>
                        </div>
                    </div>
            {!! Form::close(); !!}
        </div>
    </div>
@stop