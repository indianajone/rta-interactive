@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">{{ $place->name }}</h1>
    </div>
    @include('components.error')
    {!! Form::model($place, [
        'files' => true,
        'method' => 'PUT',
        'accept-charset' => 'utf-8',
        'route' => ['cms.places.update', $place->id]
    ]) !!}
       
        <div class="row">
            <div class="col-md-8">
                @include('cms.places.partials.info')
                @include('cms.places.partials.latlng')
                @include('cms.places.partials.categories')
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                </div>
            </div>
            <div class="col-md-4">
                @include('cms.places.partials.photos')
                @include('cms.places.partials.panorama')
            </div>
        </div>
            
    {!!Form::close() !!}

@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2();
            
            var defaultOptions = {
                acceptedFiles: 'image/*',
                forceFallback: false,
                sending: function (file, xhr, formData) {
                    formData.append('_token', $('input[name=_token]').val());
                }
            }

            Dropzone.options.dzPhotos = $.extend({}, defaultOptions, {
                paramName: 'photo',
                url: '/api/places/{{ $place->id }}/photos'
            });

            Dropzone.options.dzPanorama = $.extend({}, defaultOptions, {
                paramName: 'panorama',
                uploadMultiple: false,
                url: '/api/places/{{ $place->id }}/panorama'
            });
        });
    </script>
@stop