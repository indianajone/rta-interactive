@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">เพิ่มสถานที่</h1>
    </div>
    <div class="row">
        <div class="col-md-10">
            @include('components.error')
            {!! Form::open([
                'method' => 'POST',
                'accept-charset' => 'utf-8',
                'route' => 'cms.places.store'
            ]) !!}
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
                        <div class="form-group checkbox">
                            <label>
                                {!! Form::hidden('recommended', false) !!}
                                {!! Form::checkbox('recommended') !!}
                                เป็นสถานที่แนะนำ
                            </label>
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tha">
                                @include('cms.places.partials.info', ['lang' => 'th'])
                            </div>
                            <div role="tabpanel" class="tab-pane" id="eng">
                                @include('cms.places.partials.info', ['lang' => 'en'])
                            </div>
                        </div>
                        @include('cms.places.partials.latlng')
                        @include('cms.places.partials.categories')
                        <div class="pull-right">
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2();
            $('.editor').summernote({
                minHeight: 300, 
            });
         });
    </script>
@stop