@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">เกี่ยวกับเรา</h1>
    </div>
    <div class="row">
        <div class="col-md-10">
            @include('components.error')
            {!! Form::model($page, ['route' => 'cms.about_path', 'method' => 'PUT']) !!}
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
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tha">
                                <div class="form-group">
                                    {!! Form::label('title:th', 'ชื่อหน้า') !!}
                                    {!! Form::text('title:th', null , ['class' => 'form-control', 'placeholder' => 'ชื่อหน้า']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('body:th', 'เนื้อหา') !!}
                                    {!! Form::textarea('body:th', null, ['class' => 'form-control editor', 'rows' => 5, 'placeholder' => 'เนื้อหา']) !!}
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="eng">
                                <div class="form-group">
                                    {!! Form::label('title:en', 'ชื่อหน้า') !!}
                                    {!! Form::text('title:en', null , ['class' => 'form-control', 'placeholder' => 'ชื่อหน้า']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('body:en', 'เนื้อหา') !!}
                                    {!! Form::textarea('body:en', null, ['class' => 'form-control editor', 'rows' => 5, 'placeholder' => 'เนื้อหา']) !!}
                                </div>
                            </div>
                    </div>
                </div>
            {!! Form::close(); !!}
        </div>
    </div>
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('.editor').summernote({
                minHeight: 300, 
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
@stop