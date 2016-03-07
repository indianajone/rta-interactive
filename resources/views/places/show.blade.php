@extends('layouts/master')

@section('meta')
    {{-- SEO --}}
    <meta name="description" content="{{ $place->excerpt }}">

    {{-- facebook --}}
    <meta property="fb:app_id" content="{{ env('FB_APP_ID') }}">
    <meta property="og:url" content="{{ request()->getUri() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $place->title }}">
    <meta property="og:image" content="{{ $place->thumbnail }}"/>
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="600"/>
    <meta property="og:description" content="{{ $place->excerpt }}">

    {{-- google+ --}}
    <meta itemprop="name" content="{{ $place->title }}">
    <meta itemprop="description" content="{{ $place->excerpt }}">
    <meta itemprop="image" content="{{ $place->thumbnail }}">
@stop

@section('title') {{ $place->title }} @stop

@section('banner')
    <div class="slick slick--black" v-slick>
        @foreach($place->photos()->orderBy('updated_at')->take(5)->get() as $photo)
            <div class="slick-slide slick-slide--fixed-height">
                <img src="{{ asset($photo->path) }}" alt="{{ $photo->title }}">
                <span>{{ $photo->title }}</span>
            </div>
        @endforeach
    </div>
@stop

@section('content')
    <h2 class="heading--fancy">{{ $place->title }}</h2>
    <div class="place">
        <div class="place__buttons">
            <a href="{{ map_path($place) }}"><i class="fa fa-lg fa-car"></i></a>
             @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-star-o"></i></a>
            @else
                <favorite-button place="{{ $place->id }}" favorited="{{ $place->hasFavoritedByUser(Auth::user()) }}"></favorite-button>
            @endif
            @if(!Auth::check())
                <a @click="openModal('login', 'login')"><i class="fa fa-lg fa-share-alt"></i></a>
            @else
                <social-share url="{{ place_path($place) }}"></social-share>
            @endif
            <span class="place__button">{{ $place->views }}</span>
        </div>
        
        <readmore 
            class="place__body"
            max-height="160" 
            text="{{ collect(trans('common.buttons.readmore')) }}"
            show="{{ mb_strlen($place->description, 'UTF-8') >= 800 }}"
        >
            {!! $place->description !!}
        </readmore>
    </div>
    
    @include('places.partials.photo')
    @include('places.partials.video')
    @include('places.partials.panorama')
    @include('places.partials.marker')
    @include('places.partials.nearby')

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
             It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. 
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <!-- <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button> -->

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                          <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div> 
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>

@stop