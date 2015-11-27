@extends('layouts.cms')

@section('content')
    
    <div class="heading">
        <h1 class="heading__title">เพิ่มสถานที่</h1>
    </div>
    @include('components.error')
    {!! Form::open([
        'file' => true,
        'method' => 'POST',
        'accept-charset' => 'utf-8',
        'route' => 'cms.places.store'
    ]) !!}
        <div class="row">
            @include('cms.places.partials.info')
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก">
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@stop