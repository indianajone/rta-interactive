<div class="row">
    <div class="col-md-12">
        <div class="form-group pull-right">
            <a 
                href="#modal-addvideo" 
                class="btn btn-primary"
                data-toggle="modal" 
                data-target="#modal-addvideo"
            >
                เพิ่มวีดีโอ
            </a>
        </div>
    </div>
</div>
@foreach($place->videos->chunk(4) as $set)
    <div class="row">
        @foreach($set as $video)
            <div class="col-xs-6 col-md-3 text-center">
                <a 
                    href="#modal-video-{{ $video->id }}" 
                    class="thumbnail"
                    data-toggle="modal" 
                    data-target="#modal-video-{{ $video->id }}"
                > 
                    <img src="{{ asset($video->thumbnail_path) }}" alt="{{ $video->title }}">
                </a>
                {!! Form::open([
                    'route' => ['cms.places.attachments.destroy', $place->id, $video->id], 
                    'method' => 'DELETE',
                    'class' => 'form-remove'
                ]) !!}
                    <button name="delete" class="btn btn-sm btn-danger">ลบ</button>
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>  
@endforeach


