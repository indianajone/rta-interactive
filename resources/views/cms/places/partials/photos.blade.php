<div class="row">
    <div class="pull-right">
        <a 
            href="#modal-add" 
            class="btn btn-primary"
            data-toggle="modal" 
            data-target="#modal-add"
        >
            เพิ่มรูป
        </a>
    </div>
</div>
@foreach($place->photos->chunk(4) as $set)
    <div class="row">
        @foreach($set as $photo)
            <div class="col-xs-6 col-md-3">
                <a 
                    href="#modal-{{ $photo->id }}" 
                    class="thumbnail"
                    data-toggle="modal" 
                    data-target="#modal-{{ $photo->id }}"
                > 
                    <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                </a>
            </div>
        @endforeach
    </div>  
@endforeach

