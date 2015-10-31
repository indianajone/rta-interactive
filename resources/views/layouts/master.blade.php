<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield ('script.header')
</head>
<body>
{{--     <nav class="navbar">
        <div class="container">
        
            <div class="navbar__main">
                <ul class="nav navbar-nav">
                    <li><a href="#">หน้าหลัก</a></li>
                    <li><a href="#">รายชื่อสถานที่ท่องเที่ยว</a></li>
                    <li><a href="#">แผนที่</a></li>
                    <li><a href="#">แนะนำ</a></li>
                    <li><a href="#">เกี่ยวกับเรา</a></li>
                </ul>

                <span class="navbar__main__shadow"></span>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav> --}}
    <div id="app" class="container">
        @yield ('content')
    </div>
    <script src="js/app.js"></script>
    @yield ('script.footer')
</body>
</html>