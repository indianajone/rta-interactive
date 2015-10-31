@extends('layouts.master')

@section('script.header')
    
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
    <script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/routeboxer/src/RouteBoxer.js"></script>

@stop

@section('content')
    {{-- <div class="jumbotron">
        <div class="row">
            <div class="col-md-3">
                <a class="logo" href="#">
                    <img src="images/logo.png" alt="สำนักงานส่งเสริมการท่องเที่ยวกองทัพบก">
                </a>
            </div>
            <div class="col-md-9">
                <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#homeCarousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class="first-slide" src="http://placehold.it/850x500" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <home-view></home-view>
@stop