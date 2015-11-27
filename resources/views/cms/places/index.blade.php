@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">
            สถานที่
            <a class="heading__button--success" href="{{ route('cms.places.create') }}">    <i class="fa fa-plus"></i>    
                เพิ่ม
            </a>
        </h1>
        <div class="heading__tools">
            <div class="col-md-6 col-md-offset-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ค้นหา">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>ชื่อสถานที่</th>
                <th>ที่อยู่</th>
            </tr>
        </thead>
        <tbody>
            @forelse($places as $place)
                <tr>
                    <td>{{ $place->id }}</td>
                    <td>
                        <a href="{{ route('cms.places.edit', $place->id) }}">{{ $place->name }}</a>
                    </td>
                    <td>{{ $place->street }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center text-muted" colspan="3">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {!! $places->render() !!}
    </div> 
@stop