@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">{{ $place->name }}</h1>
    </div>
    <div class="row">
        @include('components.error')
       
            <div class="col-md-12">
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
                                <a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">คลังภาพ</a>
                            </li>
                            <li role="presentation">
                                <a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">วีดีโอ</a>
                            </li>
                            <li role="presentation">
                                <a href="#panoramas" aria-controls="panoramas" role="tab" data-toggle="tab">ภาพพาโนรามา</a>
                            </li>
                            <li role="presentation">
                                <a href="#markers" aria-controls="markers" role="tab" data-toggle="tab">ภาพ​ AR Marker</a>
                            </li>
                            <li role="presentation">
                                <a href="#nearby" aria-controls="nearby" role="tab" data-toggle="tab">สถานที่ท่องเที่ยวใกล้เคียง</a>
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tha">
                                {!! Form::model($place, [
                                    'files' => true,
                                    'method' => 'PUT',
                                    'accept-charset' => 'utf-8',
                                    'route' => ['cms.places.update', $place->id]
                                ]) !!}
                                    <div class="form-group checkbox">
                                        <label>
                                            {!! Form::hidden('recommended', false) !!}
                                            {!! Form::checkbox('recommended') !!}
                                            เป็นสถานที่แนะนำ
                                        </label>
                                    </div>
                                    @include('cms.places.partials.info', ['lang' => 'th'])
                                    @include('cms.places.partials.latlng')
                                    @include('cms.places.partials.categories')
                                    <div class="pull-right">
                                        <div class="form-group">
                                            <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                                        </div>
                                    </div>
                                {!!Form::close() !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="eng">
                                {!! Form::model($place, [
                                    'files' => true,
                                    'method' => 'PUT',
                                    'accept-charset' => 'utf-8',
                                    'route' => ['cms.places.update', $place->id]
                                ]) !!}
                                    @include('cms.places.partials.info', ['lang' => 'en'])
                                    @include('cms.places.partials.latlng')
                                    @include('cms.places.partials.categories')
                                    <div class="pull-right">
                                        <div class="form-group">
                                            <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="photos">
                                @include('cms.places.partials.photos')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="videos">
                                @include('cms.places.partials.videos')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="panoramas">
                                @include('cms.places.partials.panoramas')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="markers">
                                @include('cms.places.partials.markers')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="nearby">
                                @include('cms.places.partials.nearby')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop

@section('footer')
    
    <div class="modals">
        <div id="modal-addimage" class="modal fade">
            {!! Form::open(['route' => ['cms.places.attachments.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
                @include('cms.components.modals.image')
            {!! Form::close() !!}
        </div>
        @foreach($place->photos as $photo)
            <div id="modal-image-{{ $photo->id }}" class="modal fade">
                {!! Form::model($photo, ['route' => ['cms.places.attachments.update', $place->id, $photo->id], 'method' => 'PUT', 'files' => true]) !!}
                    @include('cms.components.modals.image')
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>
    
    <div class="modals">
        <div id="modal-addvideo" class="modal fade">
            {!! Form::open(['route' => ['cms.places.video.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
                @include('cms.components.modals.video')
            {!! Form::close() !!}
        </div>
        @foreach($place->videos as $video)
            <div id="modal-video-{{ $video->id }}" class="modal fade">
                {!! Form::model($video, ['route' => ['cms.places.video.update', $place->id, $video->id], 'method' => 'PUT', 'files' => true]) !!}
                    @include('cms.components.modals.video')
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>

    <div class="modals">
        <div id="modal-addpanorama" class="modal fade">
            {!! Form::open(['route' => ['cms.places.panorama.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
                @include('cms.components.modals.panorama')
            {!! Form::close() !!}
        </div>
        @foreach($place->panoramas as $panorama)
            <div id="modal-panorama-{{ $panorama->id }}" class="modal fade">
                {!! Form::model($panorama, ['route' => ['cms.places.panorama.update', $place->id, $panorama->id], 'method' => 'PUT', 'files' => true]) !!}
                    @include('cms.components.modals.panorama')
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>
    
    <div class="modals">
        <div id="modal-addmarker" class="modal fade">
            {!! Form::open(['route' => ['cms.places.marker.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
                @include('cms.components.modals.marker')
            {!! Form::close() !!}
        </div>
        @foreach($place->markers as $marker)
            <div id="modal-marker-{{ $marker->id }}" class="modal fade">
                {!! Form::model($marker, ['route' => ['cms.places.marker.update', $place->id, $marker->id], 'method' => 'PUT', 'files' => true]) !!}
                    @include('cms.components.modals.marker')
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>

    <div class="modals">
        <div id="modal-addnearby" class="modal fade">
            {!! Form::open(['route' => ['cms.places.nearby.store', $place->id], 'method' => 'POST', 'files' => true]) !!}
                @include('cms.components.modals.nearby')
            {!! Form::close() !!}
        </div>
        @foreach($place->nearby as $nearby)
            <div id="modal-nearby-{{ $nearby->id }}" class="modal fade">
                {!! Form::model($nearby, ['route' => ['cms.places.nearby.update', $place->id, $nearby->id], 'method' => 'PUT', 'files' => true]) !!}
                    @include('cms.components.modals.nearby')
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>

@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function() {
            $('.select2').select2();
            
            $('.editor').summernote({
                minHeight: 300, 
            });

            $('button[name="delete"]').on('click', function (e) {
                e.preventDefault();
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this!",
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function (confirmed) {
                    if(confirmed) {
                        $(e.target).closest('form').submit();
                    }
                });
            });
        });
    </script>
@stop