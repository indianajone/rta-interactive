<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/cms.css">
    @yield ('script.header')
</head>
    <body>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-navicon"></i>
                    </button>
                    <a class="navbar__brand" href="#">
                        <img src="/images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
                        <span>สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก</span>
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><p class="navbar-text">สวัสดี {{ Auth::user()->name }}</p></li>
                        <li><a href="{{ route('cms.logout_path') }}">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="sidebar">
                    <ul class="sidebar__nav">
                        <li class="{{ Route::is('cms.dashboard_path') ? 'active' : '' }}">
                            <a href="{{ route('cms.dashboard_path') }}">
                                <i class="fa fa-home"></i>
                                <span>หน้าหลัก</span>
                            </a>
                        </li>
                        <li class="{{ Route::is('cms.place_path.*') ? 'active' : '' }}">
                            <a href="{{ route('cms.place_path.index') }}">
                                <i class="fa fa-map"></i>
                                <span>สถานที่</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="main">
                    @yield ('content')
                </div>
            </div>
        </div>
        @yield ('script.footer')
    </body>
</html>

