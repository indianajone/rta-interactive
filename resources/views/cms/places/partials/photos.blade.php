<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">คลังภาพ</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div id="dz-photos" class="dropzone"></div>
        </div>
        <div class="row">
            @foreach($place->photos as $photo)
                <div class="col-md-4 col-xs-6">
                    <div class="preview">
                        <img 
                            class="img-responsive" 
                            src="{{ asset($photo->thumbnail_path) }}" 
                            alt=""
                        >
                    </div> 
                </div>
            @endforeach
        </div>
    </div>
</div>