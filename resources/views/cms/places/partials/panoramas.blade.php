<div class="row">
    <div class="col-md-12">
        <div class="form-group pull-right">
            <a 
                href="#modal-addpanorama" 
                class="btn btn-primary"
                data-toggle="modal" 
                data-target="#modal-addpanorama"
            >
                เพิ่มภาพ
            </a>
        </div>
    </div>
</div>
@foreach($place->panoramas->chunk(4) as $set)
    <div class="row">
        @foreach($set as $photo)
            <div class="col-xs-6 col-md-3">
                <a 
                    href="#modal-panorama-{{ $photo->id }}" 
                    class="thumbnail"
                    data-toggle="modal" 
                    data-target="#modal-panorama-{{ $photo->id }}"
                > 
                    <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                </a>
            </div>
        @endforeach
    </div>  
@endforeach
