@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">{{ $place->name }}</h1>
    </div>
    <div class="row">
        @include('components.error')
        {!! Form::model($place, [
            'files' => true,
            'method' => 'PUT',
            'accept-charset' => 'utf-8',
            'route' => ['cms.places.update', $place->id]
        ]) !!}
            <div class="col-md-10">
               <div class="panel with-nav-tabs">
                    <div class="panel-heading clearfix">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tha" aria-controls="tha" role="tab" data-toggle="tab">ไทย</a>
                            </li>
                            <li role="presentation">
                                <a href="#eng" aria-controls="eng" role="tab" data-toggle="tab">อังกฤษ</a>
                            </li>
                            <li role="presentation">
                                <a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">หมวด</a>
                            </li>
                            <li role="presentation">
                                <a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">คลังภาพ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tha">
                                <div class="form-group checkbox">
                                    <label>
                                        {!! Form::hidden('recommended', false) !!}
                                        {!! Form::checkbox('recommended') !!}
                                        เป็นสถานที่แนะนำ
                                    </label>
                                </div>
                                @include('cms.places.partials.info', ['lang' => 'th'])
                                @include('cms.places.partials.latlng')
                                <div class="pull-right">
                                    <div class="form-group">
                                        <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="eng">
                                @include('cms.places.partials.info', ['lang' => 'en'])
                                <div class="pull-right">
                                    <div class="form-group">
                                        <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="photos">
                                @include('cms.places.partials.photos')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="categories">
                                @include('cms.places.partials.categories')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!!Form::close() !!}
    </div>
@stop

@section('footer')
    <div id="modal-add" class="modal fade">
        {!! Form::open(['route' => ['cms.places.attachments.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
            @include('cms.components.modals.image')
        {!! Form::close() !!}
    </div>
    @foreach($place->photos as $photo)
        <div id="modal-{{ $photo->id }}" class="modal fade">
            {!! Form::model($photo, ['route' => ['cms.places.attachments.update', $place->id, $photo->id], 'method' => 'PUT', 'files' => true]) !!}
                @include('cms.components.modals.image')
            {!! Form::close() !!}
        </div>
    @endforeach
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