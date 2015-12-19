<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">คลังภาพ</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div id="dz-photos" class="dropzone"></div>
        </div>
        @foreach($place->photos->chunk(2) as $set)
            <div class="row">
                @foreach($set as $photo)
                    <div class="preview col-xs-6">
                        <a 
                            href="#modal" 
                            data-toggle="modal" 
                            data-photo-id="{{ $photo->id }}" 
                            data-photo-src="{{ asset($photo->path) }}"
                            data-photo-thumbnail="{{ $photo->isThumbnail() }}"
                        >
                            @if ($photo->isThumbnail())
                                <span class="label label-primary label--absolute">thumbnail</span>
                            @endif
                            <img class="img-responsive" src="{{ asset($photo->thumbnail_path) }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

