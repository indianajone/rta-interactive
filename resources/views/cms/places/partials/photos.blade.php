<div class="row">
    <div class="col-md-12">
        <div class="form-group pull-right">
            <a 
                href="#modal-addimage" 
                class="btn btn-primary"
                data-toggle="modal" 
                data-target="#modal-addimage"
            >
                เพิ่มรูป
            </a>
        </div>
    </div>
</div>
@foreach($place->photos->chunk(4) as $set)
    <div class="row">
        @foreach($set as $photo)
            <div class="col-xs-6 col-md-3">
                <a 
                    href="#modal-image-{{ $photo->id }}" 
                    class="thumbnail"
                    data-toggle="modal" 
                    data-target="#modal-image-{{ $photo->id }}"
                > 
                    <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                </a>
            </div>
        @endforeach
    </div>  
@endforeach

