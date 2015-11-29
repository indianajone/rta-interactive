@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">เพิ่มหมวดหมู่สถานที่</h1>
    </div>
    @include('components.error')
    {!! Form::open([
        'method' => 'POST',
        'accept-charset' => 'utf-8',
        'route' => 'cms.categories.store'
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