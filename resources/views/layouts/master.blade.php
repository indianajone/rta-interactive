<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Product">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf_token" id="csrf_token" value={{ csrf_token() }}>
    <meta name="author" content="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
    @yield ('meta')
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/app.css">
    @yield ('script.header')
</head>
<body>
    <div id="app" class="{{ page_class() }}">
        <nav class="navbar navbar-static-top">
            <div class="navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-bottom" aria-expanded="false" aria-controls="navbar-bottom">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-navicon"></i>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img src="/images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
                            <span>สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก</span>
                        </a>
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
        <div class="wrapper">
            <div class="{{ !Route::is('map_path') ? 'container' : 'container-fluid' }}">
                @yield ('content')
            </div>
        </div>
        <footer class="footer">
            <div class="footer__top">
                <div class="container">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <address>
                            <p>
                                <strong>สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก</strong><br>
                                279 อาคารสวัสดิการทหารบก ชั้น 3 ถนนศรีอยุธยา<br>
                                แขวงวชิระ เขตดุสิต กรุงเทพมหานคร 10300
                            </p>
                            <p>
                                โทร. 02-2826835, 02-2975831, 083-1232647<br>
                                โทรสาร. 02-2826835, 02-2820620 โทร.ทบ. 95831<br>
                                โทรสาร.ทบ. 91635
                            </p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        @include('components/navbar-social')
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <span class="copyright__left">Copyright &copy; 2015 ATS.MI.TH All Rights Reserved.</span>
                    <span class="copyright__right">สงวนสิทธิ์โดย สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก</span>
                </div>
            </div>
        </footer>
        @include('components.modals.auth')
    </div>
    @include ('components.vars')
    <script src="/js/app.js"></script>
    @yield ('script.footer')
</body>
</html>