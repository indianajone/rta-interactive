<form 
    @submit.prevent="navigateMe"
    @keyup.prevent.enter="navigateMe"
    accept-charset="utf-8"
    v-cloak
>
    <fieldset class="top">
        <mode :mode.sync="route.travelMode"></mode>
        
        <origin :origin.sync="route.origin" inline-template>
            <div class="form-group">
                <input 
                    v-el:origin
                    v-model="value"
                    @blur="onBlur"
                    @focus="onFocus"
                    type="text"
                    class="form-control"
                    placeholder="{{ trans('map.origin') }}"
                    required >
            </div>
        </origin>
        
        <waypoint :waypoints.sync="route.waypoints"></waypoint>
        
        @include('components.destination')
    </fieldset>
    @if ($nearby)
    <fieldset class="bottom" v-if="route.travelMode == 'DRIVING'">
        <div class="waypoints">
            <legend>{{ trans('map.nearby.title') }}</legend>
            <div class="col-xs-12">
                <input v-model="nearby" type="checkbox">
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
    <fieldset class="text-center" v-if="hasDirection">
        <direction-button text="{{ collect(trans('common.buttons.direction')) }}"></direction-button>   
    </fieldset>
</form>