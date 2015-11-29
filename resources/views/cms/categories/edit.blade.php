@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">เพิ่มหมวดหมู่สถานที่</h1>
    </div>
    @include('components.error')
    {!! Form::model($category, [
        'method' => 'PUT',
        'accept-charset' => 'utf-8',
        'route' => 'cms.categories.update'
    ]) !!}
        <div class="row">
            @include('cms.categories.partial.form')
        </div>
        
    {!! Form::close() !!}
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2();
        });
    </script>
@stop