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
                <th width="5%"></th>
                <th>ชื่อ</th>
                <th class="text-center">จำนวนสถานที่</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $group)
                <tr>
                    <td>
                        <a 
                            class="collapseable collapsed"
                            href="#group-{{ $group->id }}"
                            role="button"
                            data-toggle="collapse" 
                            aria-expanded="true" 
                            aria-controls="#group-{{ $group->id }}"
                        >
                            <span class="sr-only">toggle</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('cms.categories.edit', $group->id) }}">
                            {{ $group->name }}
                        </a>
                    </td>
                    <td class="text-center">{{ $group->totalPlaces() }}</td>
                </tr>

                <tbody id="group-{{ $group->id }}" class="collapse">
                    @foreach($group->children as $category)
                        <tr>
                            <td></td>
                            <td> 
                                <a href="{{ route('cms.categories.edit', $category->id) }}">
                                    ---- {{ $category->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $category->places->count() }}</td>
                        </tr>
                    @endforeach
                <tbody>
            @empty
                <tr>
                    <td class="text-center text-muted" colspan="3">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop