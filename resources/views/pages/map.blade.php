@extends('layouts.master')

@section('script.header')
    
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
    <script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/routeboxer/src/RouteBoxer.js"></script>

@stop

@section('content')
    <interactive-map inline-template
        :things="{{ $options }}"
    >
        <div id="map" class="interactive-map"
            :style="{ width: width + 'px', height: height + 'px'}"
        >
            @if (!$place)
                
                <form 
                    @submit.prevent="navigateMe"
                    @keyup.prevent.enter="navigateMe"
                    accept-charset="utf-8"
                >
                    <fieldset class="top">
                        <mode :mode.sync="route.travelMode"></mode>
                        <origin :origin.sync="route.origin"></origin>
                        <waypoint :waypoints.sync="route.waypoints"></waypoint>
                        <destinations 
                            @change="navigateMe"
                            :selected.sync="route.destination"
                        >
                        </destinations>
                    </fieldset>
                    <fieldset class="bottom" v-if="route.travelMode == 'DRIVING'">
                        <div class="avoid">
                            
                        </div>
                        <div class="waypoints">
                            <legend>{{ trans('map.waypoints.title') }}</legend>
                            <div class="col-xs-6" v-for="thing in things">
                                <label class="checkbox-inline">
                                     <input 
                                        v-model="thing.selected"
                                        type="checkbox"
                                    > @{{ thing.name }}    
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <google-map v-ref:google :route="route" :things="selectedThings"></google-map>
            @else
                <google-map v-ref:google :places="[{{ $place->latLng }}]"></google-map>
            @endif
        </div>
    </interactive-map>
@stop