<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield ('title', 'สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก')</title>
    <link rel="stylesheet" href="/css/cms.css">
    @yield ('script.header')
</head>
    <body>

        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Please login</h2>
            @include('components.error')
            <form action="{{ route('cms.login_path') }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email" class="sr-only">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password address</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-success">Login</button>
            </form>
        </div>
        
    </body>
</html>