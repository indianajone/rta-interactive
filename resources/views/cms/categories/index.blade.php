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
                <th></th>
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
                    <td>
                        {!! Form::open([
                            'route' => ['cms.categories.destroy', $group->id], 
                            'method' => 'DELETE'
                        ]) !!}
                            <button name="delete" class="btn btn-danger">ลบ</button>
                        {!! Form::close() !!}
                    </td>
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
                            <td>
                                {!! Form::open([
                                    'route' => ['cms.categories.destroy', $group->id], 
                                    'method' => 'DELETE'
                                ]) !!}
                                    <button name="delete" class="btn btn-danger">ลบ</button>
                                {!! Form::close() !!}
                            </td>
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

@section('script.footer')
    <script type="text/javascript" charset="utf-8">
        $(function() {
            $('button[name="delete"]').on('click', function (e) {
                e.preventDefault();
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this!",
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function (confirmed) {
                    if(confirmed) {
                        $(e.target).closest('form').submit();
                    }
                });
            });
        });
    </script>
@stop