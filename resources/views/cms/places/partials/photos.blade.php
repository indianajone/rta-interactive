@foreach($place->photos->chunk(4) as $set)
    <div class="row">
        @foreach($set as $photo)
            <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                    <img src="{{ asset($photo->thumbnail_path) }}" alt="{{ $photo->title }}">
                </a>
            </div>
        @endforeach
    </div>  
@endforeach

