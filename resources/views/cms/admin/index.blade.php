@extends('layouts.cms')

@section('content')
    <div class="heading">
        <h1 class="heading__title">
            ผู้ดูแลระบบ
            <a class="heading__button--success" href="{{ route('cms.admin.create') }}">    <i class="fa fa-plus"></i>    
                เพิ่ม
            </a>
        </h1>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>อีเมลล์</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('cms.admin.edit', $user->id) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @unless($user->id == Auth::id())
                            {!! Form::open([
                                'route' => ['cms.admin.destroy', $user->id], 
                                'method' => 'DELETE'
                            ]) !!}
                                <button name="delete" class="btn btn-danger">ลบ</button>
                            {!! Form::close() !!}
                        @endunless
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center text-muted" colspan="3">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {!! $users->render() !!}
    </div> 
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