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
    <link rel="stylesheet" href="/css/app.css">
</head>
    <body class="supports">
        <div class="container-fluid">
            <nav class="navbar">
                <div class="navbar-top">
                    <div class="container">
                        <div class="navbar-header">
                            <div class="navbar-brand">
                                <a href="/"><img class="navbar-brand__logo" src="/images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก"></a>
                                สำนักงานส่งเสริมการท่องเที่ยว กองทัพบก
                                <small>ตะลุยเที่ยวในเขตทหาร กองทัพบก</small>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h3 class="supports__title">
                    กรุณาอัพเกรดเบราว์เซอร์ของคุณ​
                    <small>คุณสามารถเลือกเบราว์เซอร์ได้จากรายการแนะนำนี้</small>
                </h3>
                <div class="supports__browser">
                    <a href="https://www.google.com/chrome/browser/desktop/" target="_blank">
                        <img style="max-width: 100px;" src="/images/browser-icons/chrome.png" alt="chrome">
                    </a>
                    <div class="caption text-center">
                        <h4>chrome</h4>
                    </div>
                </div>      
            
                <div class="supports__browser">
                    <a href="http://www.mozilla.org/firefox/new/" target="_blank">
                        <img style="max-width: 100px;" src="/images/browser-icons/firefox.png" alt="firefox">
                    </a>
                    <div class="caption text-center">
                        <h4>firefox</h4>
                    </div>
                </div>      
            
                <div class="supports__browser">
                    <a href="http://windows.microsoft.com/ie" target="_blank">
                        <img style="max-width: 100px;" src="/images/browser-icons/ie.png" alt="ie">
                    </a>
                    <div class="caption text-center">
                        <h4>internet explorer</h4>
                    </div>
                </div>      

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
        </div>
    </body>
</html>