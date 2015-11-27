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
            @include('cms.places.partials.info')
        </div>
        <hr>
        <div class="row">
            @include('cms.places.partials.categories')
        </div>
        <hr>
        <div class="row">
            @include('cms.places.partials.photos')
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('panorama', 'รูปพาโนราม่า') !!}
                @if($place->panorama)
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-responsive" src="{{ asset($place->panorama->thumbnail_path) }}" alt="">
                        </div>
                        <div class="col-md-8">
                            <div id="dz-placepanorama" class="dropzone"></div>
                        </div>
                    </div>
                @else
                    <div id="dz-placepanorama" class="dropzone"></div>
                @endif
            </div>
        </div>
        <hr>
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                </div>
            </div>
        </div>
    {!!Form::close() !!}

@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2();
            
            defaultOptions = {
                acceptedFiles: 'image/*',
                forceFallback: false,
                sending: function (file, xhr, formData) {
                    formData.append('_token', $('input[name=_token]').val());
                }
            }
            Dropzone.options.dzPlacephotos = $.extend(defaultOptions, {
                paramName: 'photo',
                url: '/api/places/{{ $place->id }}/photos'
            });
            Dropzone.options.dzPlacepanorama = $.extend(defaultOptions, {
                paramName: 'panorama',
                uploadMultiple: false,
                url: '/api/places/{{ $place->id }}/panorama'
            });
        });
    </script>
@stop