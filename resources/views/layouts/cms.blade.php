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
        <div id="app" class="container">
            @yield ('content')
        </div>
        @yield ('script.footer')
    </body>
</html>

