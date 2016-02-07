<div class="row">
    <div class="col-md-12">
        <div class="form-group pull-right">
            <a 
                href="#modal-addmarker" 
                class="btn btn-primary"
                data-toggle="modal" 
                data-target="#modal-addmarker"
            >
                เพิ่มภาพ
            </a>
        </div>
    </div>
</div>
@foreach($place->markers->chunk(4) as $set)
    <div class="row">
        @foreach($set as $marker)
            <div class="col-xs-6 col-md-3 text-center">
                <a 
                    href="#modal-marker-{{ $marker->id }}" 
                    class="thumbnail"
                    data-toggle="modal" 
                    data-target="#modal-marker-{{ $marker->id }}"
                > 
                    <img src="{{ asset($marker->thumbnail_path) }}" alt="{{ $marker->title }}">
                </a>
                {!! Form::open([
                    'route' => ['cms.places.attachments.destroy', $place->id, $marker->id], 
                    'method' => 'DELETE',
                    'class' => 'form-remove'
                ]) !!}
                    <button name="delete" class="btn btn-sm btn-danger">ลบ</button>
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>  
@endforeach
