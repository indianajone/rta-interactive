<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">พาโนรามา</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div id="dz-panorama" class="dropzone"></div>
        </div>
        @if($place->panorama)
            <div class="preview">
                <img class="img-responsive" src="{{ asset($place->panorama->thumbnail_path) }}" alt="">
            </div>
        @endif
    </div>
</div>