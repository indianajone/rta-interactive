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
            <div class="col-md-8">
                @include('cms.categories.partial.form')
            </div>
        </div>
        
    {!! Form::close() !!}
@stop

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function(){
            $('.select2').select2({
                placeholder: { id: 'ไม่มี', value: null }
            });
        });
    </script>
@stop