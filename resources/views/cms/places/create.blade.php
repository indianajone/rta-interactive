@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">เพิ่มสถานที่</h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('components.error')
            {!! Form::open([
                'file' => true,
                'method' => 'POST',
                'accept-charset' => 'utf-8',
                'route' => 'cms.places.store'
            ]) !!}
                @include('cms.places.partials.info')
                @include('cms.places.partials.latlng')
                @include('cms.places.partials.categories')
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2();
         });
    </script>
@stop