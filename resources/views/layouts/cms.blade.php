<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/cms.css">
    @yield('script.header')
</head>
    <body>
        <div id="cms">
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
                    <div class="navbar-collapse collapse">
                        @if(Auth::check())
                            <ul class="nav navbar-nav navbar-right">
                                <li><p class="navbar-text">สวัสดี {{ Auth::user()->name }}</p></li>
                                <li><a href="{{ route('cms.logout_path') }}">ออกจากระบบ</a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div id="navbar" class="sidebar collapse">
                        <ul class="sidebar__nav">
                            <li {{ Route::is('cms.dashboard_path') ? 'active' : '' }}>
                                <a href="{{ route('cms.dashboard_path') }}">
                                    <i class="fa fa-home"></i>
                                    <span>หน้าหลัก</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('cms.ceo_path') ? 'active' : '' }}">
                                <a href="{{ route('cms.ceo_path') }}">
                                    <i class="fa fa-flag"></i>
                                    <span>ผู้บังคับบัญชา</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('cms.about_path') ? 'active' : '' }}">
                                <a href="{{ route('cms.about_path') }}">
                                    <i class="fa fa-info"></i>
                                    <span>เกี่ยวกับเรา</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('cms.places.*') ? 'active' : '' }}">
                                <a href="{{ route('cms.places.index') }}">
                                    <i class="fa fa-compass"></i>
                                    <span>สถานที่</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('cms.categories.*') ? 'active' : '' }}">
                                <a href="{{ route('cms.categories.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>หมวดหมู่สถานที่</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('cms.admin.*') ? 'active' : '' }}">
                                <a href="{{ route('cms.admin.index') }}">
                                    <i class="fa fa-user"></i>
                                    <span>ผู้ดูแลระบบ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="main">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('footer')
        <script src="/js/vendor.js"></script>
        <script>
            $(function() {
                var hash = window.location.hash;
                hash && $('ul.nav a[href="' + hash + '"]').tab('show');
                $('.nav-tabs a').click(function (e) {
                    $(this).tab('show');
                    var scrollmem = $('body').scrollTop();
                    window.location.hash = this.hash;
                    $('html,body').scrollTop(scrollmem);
                });
            });
        </script>
        @yield('script.footer')
        @include('components.flash')
    </body>
</html>

