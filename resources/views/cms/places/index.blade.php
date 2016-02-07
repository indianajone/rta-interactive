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
                <th width="10%">รูปภาพ</th>
                <th>สถานที่</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($places as $place)
                <tr>
                    <td>
                        <img class="img-responsive" src="{{ asset($place->thumbnail) }}" alt="">
                    </td>
                    <td>
                        @if($place->recommended) <span class="label label-primary">แนะนำ</span> @endif
                        <a href="{{ route('cms.places.edit', $place->id) }}">{{ $place->name }}</a>
                        <p>{{ $place->address }}</p>
                    </td>
                    <td>
                        {!! Form::open([
                            'route' => ['cms.places.destroy', $place->id], 
                            'method' => 'DELETE'
                        ]) !!}
                            <button name="delete" class="btn btn-danger">ลบ</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center text-muted" colspan="4">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {!! $places->render() !!}
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