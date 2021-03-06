<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Product">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" id="csrf_token" value={{ csrf_token() }}>
    <meta name="author" content="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
    <meta name="desctiption" content="ตะลุยเที่ยวในเขตทหาร กองทัพบก">
    @yield ('meta')
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก')</title>
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/app.css">
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield ('script.header')
</head>
<body>
    <div id="app" class="{{ page_class() }}">
        <nav class="navbar">
            <div class="navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-bottom" aria-expanded="false" aria-controls="navbar-bottom">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-navicon"></i>
                        </button>
                        <div class="navbar-brand">
                            <a href="/"><img class="navbar-brand__logo" src="/images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก"></a>
                            สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก
                            <small>ตะลุยเที่ยวในเขตทหาร กองทัพบก</small>
                        </div>
                    </div>
                    <div class="navbar-right">
                        @include('components/navbar-social')
                        @include('components/navbar-auth')
                        @include('components/navbar-flag')
                    </div>
                </div>
            </div>
            <div class="navbar-bottom collapse navbar-collapse">
                <div class="container">
                    <ul class="navbar-main visible-xs">
                        <li>
                            <ul class="nav nav-pills">
                                @if(!Auth::check())
                                    <li>
                                        <a @click="openModal('login', 'login')" class="navbar-nav__link">{{ trans('menu.login') }}</a>
                                    </li>
                                 @else 
                                    <li>
                                        <a href="{{ route('profile_path', ['lang' => session()->get('locale')]) }}" class="navbar-nav__link">{{ Auth::user()->name }}</a>
                                    </li>
                                    <li>
                                        <logout text={{ trans('menu.logout') }}></logout>
                                    </li>
                                @endif
                                <li class="pull-right">@include('components/navbar-flag')</li>
                            </ul>
                        </li>
                    </ul>
                    @include('components.search')
                    <ul class="navbar-main">
                        <li>{!! nav_route('home', 'home') !!}</li>
                        <li>{!! nav_route('places_path', 'places') !!}</li>
                        <li>{!! nav_route('map_path', 'map') !!}</li>
                        <li>{!! nav_route('recommended_path', 'recommended') !!}</li>
                        <li>{!! nav_route('about_path', 'about') !!}</li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield ('banner')
        <div class="{{ Route::is('map_path') ? 'container-fluid' : 'container' }}">
            @yield ('content')
        </div>
        <footer class="footer">
            <div class="footer__top">
                <div class="container">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        @include('components.address')
                    </div>
                    <div class="col-md-3">
                        @include('components.navbar-social')
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="thai">Copyright &copy; 2015 armytour.go.th All Rights Reserved.</div>
                    <div class="eng">สงวนสิทธิ์โดย สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก</div>
                </div>
            </div>
        </footer>
        @include('components.modals.auth')
    </div>
    @include ('components.vars')
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&amp;libraries=places"></script>
    <script src="/js/app.js"></script>
    @yield ('script.footer')
</body>
</html>