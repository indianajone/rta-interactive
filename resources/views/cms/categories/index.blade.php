@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">
            หมวดหมู่สถานที่
            <a class="heading__button--success" href="{{ route('cms.categories.create') }}">    <i class="fa fa-plus"></i>    
                เพิ่ม
            </a>
        </h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th class="text-center">จำนวนสถานที่</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $group)
                <tr>
                    <td>
                        <a 
                            href=".group-{{ $group->id }}"
                            role="button"
                            data-toggle="collapse" 
                            aria-expanded="true" 
                            aria-controls="group-{{ $group->id }}"
                        >
                            <i class="fa fa-plus"></i> 
                        </a>
                        <a href="{{ route('cms.categories.edit', $group->id) }}">
                            {{ $group->name }}
                        </a>
                    </td>
                    <td class="text-center">{{ $group->totalPlaces() }}</td>
                </tr>
                @foreach($group->children as $category)
                    <tr class="group-{{ $group->id }} collapse {{ $group->id == 1 ? 'in' : '' }}">
                        <td> 
                            <a href="{{ route('cms.categories.edit', $category->id) }}">
                                ---- {{ $category->name }}
                            </a>
                        </td>
                        <td class="text-center">{{ $category->places->count() }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td class="text-center text-muted" colspan="3">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop