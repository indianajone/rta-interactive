@extends('layouts.master')

@section('script.header')
    
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
    <script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/routeboxer/src/RouteBoxer.js"></script>

@stop

@section('content')
    <interactive-map></interactive-map>
@stop