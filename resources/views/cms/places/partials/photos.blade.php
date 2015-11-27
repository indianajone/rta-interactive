<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('photo', 'รูปภาพ') !!}
                <div id="dz-placephotos" class="dropzone"></div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($place->photos as $photo)
            <div class="col-md-3">
                <div class="preview">
                    <img class="img-responsive" src="{{ asset($photo->thumbnail_path) }}" alt="">
                </div> 
            </div>
        @endforeach
    </div>
</div>