@extends('layouts.master')

@section('script.header')
    
    <script src="//maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
    <script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/routeboxer/src/RouteBoxer.js"></script>

@stop

@section('content')
    <interactive-map inline-template :things="{{ $options }}" :place="{{ $place or '{}' }}">
        <div id="map" class="interactive-map">
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
                @if ($place)
                <fieldset class="bottom" v-if="route.travelMode == 'DRIVING'">
                    <div class="waypoints">
                        <legend>{{ trans('map.nearby.title') }}</legend>
                        <div class="col-xs-12">
                            <input v-model="nearby"type="checkbox">
                            {{ trans('map.nearby.show') }}
                        </div>
                    </div>
                </fieldset>
                @endif
                <fieldset class="bottom" v-if="route.travelMode == 'DRIVING'">
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
            <google-map :route="route" :things="selectedThings"></google-map>
        </div>
    </interactive-map>
@stop