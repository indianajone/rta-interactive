<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield ('script.header')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-static-top">
            <div class="navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <img src="images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
                            <span>สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก</span>
                        </a>
                    </div>
                    <div class="navbar-right">
                        @include('components/navbar-social')
                        <ul class="nav navbar-nav">
                            <li><a class="navbar-nav__link" href="#">เข้าสู่ระบบ</a></li>
                            <li><a class="navbar-nav__link" href="#">ลงทะเบียน</a></li>
                            <li><a class="navbar-nav__link" href="#">ลืมรหัสผ่าน</a></li>
                        </ul>
                        @include ('components/navbar-flag')
                    </div>
                </div>
            </div>
            @yield ('banner')
            <div class="navbar-bottom collapse navbar-collapse">
                <div class="container">
                    <ul class="navbar-main">
                        <li><a class="navbar-main__link--active" href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li><a class="navbar-main__link" href="#">รายชื่อสถานที่ท่องเที่ยว</a></li>
                        <li><a class="navbar-main__link" href="{{ route('map_path') }}">แผนที่</a></li>
                        <li><a class="navbar-main__link" href="#">แนะนำ</a></li>
                        <li><a class="navbar-main__link" href="{{ route('about_path') }}">เกี่ยวกับเรา</a></li>
                    </ul>
                    <search></search>
                </div>
            </div>
        </nav>
        <div class="{{ Route::currentRouteNamed('map_path') != 'map' ? 'container' : 'container-fluid' }}">
            @yield ('content')
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
    </div>
    <script src="js/app.js"></script>
    @yield ('script.footer')
</body>
</html>