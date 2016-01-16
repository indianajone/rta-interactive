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
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">รูปภาพ</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button id="btnMakeThumbnail" type="button" class="btn btn-primary">ใช้เป็นรูป thumbnail</button>
                    <button id="btnDelete" type="button" class="btn btn-danger">ลบ</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            var token = $('input[name=_token]').val();
            $('.select2').select2();
            $('.editor').summernote({
                minHeight: 300, 
            });
            
            $('#modal')
                .on('show.bs.modal', function (e) {
                    var $button = $(e.relatedTarget);
                    var $modal = $(this);
                    var $body = $modal.find('.modal-body');
                    var $footer = $modal.find('.modal-footer');
                    
                    var id = $button.data('photo-id');
                    var src = $button.data('photo-src');
                    var isThumbnail = $button.data('photo-thumbnail');

                    $('<img>').attr({
                        src: src,
                        class: 'img-responsive center-block'
                    }).appendTo($body);

                    $('#btnDelete')
                        .on('click', function (e) {
                            swal({   
                                title: 'Are you sure?',
                                text: 'You will not be able to recover this imaginary file!',
                                type: 'warning',   
                                showCancelButton: true,   
                                confirmButtonColor: '#3085d6',   
                                cancelButtonColor: '#d33',   
                                confirmButtonText: 'Yes, delete it!',   
                                closeOnConfirm: false 
                            }, function() {   
                                $.ajax({
                                    url: '/api/places/{{ $place->id }}/photos/' + id,
                                    method: 'DELETE',
                                    data: {
                                        '_token': token
                                    },
                                    success: function () {
                                        swal({
                                            title: 'Deleted!',
                                            text: 'Your file has been deleted.',
                                            type: 'success',
                                            timer: 2000,
                                            showConfirmButton: false 
                                        }, function () {
                                            location.reload();
                                        });
                                    },
                                    error: function (error) {
                                        swal({
                                            title: "error",
                                            text: "Opps something wrongs",
                                            type: "error",
                                            timer: 2000,
                                            showConfirmButton: false 
                                        });
                                    }
                                });
                            });
                        });

                    $('#btnMakeThumbnail')
                        .prop('disabled', isThumbnail)
                        .on('click', function (e) {
                            $.ajax({
                                url: '/api/places/{{ $place->id }}/photos/' + id,
                                method: 'PUT',
                                data: {
                                    '_token': token
                                },
                                success: function (result) {
                                    swal({
                                        title: "Updated.",
                                        type: "success",
                                        timer: 2000,
                                        showConfirmButton: false 
                                    }, function () {
                                        location.reload();
                                    });
                                },
                                error: function (error) {
                                    swal({
                                        title: "error",
                                        text: "Opps something wrongs",
                                        type: "error",
                                        timer: 2000,
                                        showConfirmButton: false 
                                    });
                                }
                            });
                        });
                })
                .on('hidden.bs.modal', function (e) {
                    var $body = $(this).find('.modal-body');
                    $body.html('');
                });
            
            // var defaultOptions = {
            //     acceptedFiles: 'image/*',
            //     forceFallback: false,
            //     sending: function (file, xhr, formData) {
            //         formData.append('_token', token);
            //     }
            // }

            // Dropzone.options.dzPhotos = $.extend({}, defaultOptions, {
            //     paramName: 'photo',
            //     url: '/api/places/{{ $place->id }}/photos'
            // });

            // Dropzone.options.dzPanorama = $.extend({}, defaultOptions, {
            //     paramName: 'panorama',
            //     uploadMultiple: false,
            //     url: '/api/places/{{ $place->id }}/panorama'
            // });
        });
    </script>
@stop