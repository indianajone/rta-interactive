var Vue = require('vue');

module.exports = {

    template: require('./interactive-map.template.html'),

    components: {
        googleMap: require('./GoogleMap')
    },

    data: function () {
        return {
            browserSupport: false,
            currentLocation: {},
            destinations: [{ text: 'Please select your destination', value: '' }],
            route: { origin: '', destination: '', travelMode: 'DRIVING', waypoints: [] },
            things: [
                { name: 'Gas station', value: 'gas_station', selected: true }, 
                { name: 'Hospital', value: 'hospital', selected: false },
                { name: 'Police Station', value: 'police', selected: false },
                { name: 'Food', value: 'food', selected: false },
                { name: 'Hotel', value: 'lodging', selected: false }
            ]
        }
    },

    ready: function () {
        this.init();
    },

    computed: {
        selectedOrigin: function () {
            return (this.route.origin === 'Your current position' || 
                    this.route.origin === '') ? this.currentLocation : this.route.origin;
        },
        selectedDestination: function () {
            return (this.route.destination === 'Your current position') ? this.currentLocation : this.route.destination;
        },
        selectedThings: function () {
            if (this.route.travelMode !== 'DRIVING') {
                return [];
            }

            return this.things.filter(function (thing) {
                    return thing.selected
                })
                .map(function (thing) {
                    return thing.value
                })
        },
        selectedWaypoint: function () {
            return this.route.waypoints.map(function (place) {
                return {
                    location: place.location,
                    stopover: place.stopover
                }
            });
        }
    },
 
    methods: {
        init: function () {
            if (this.isBrowserSupport()) {
                this.getCurrentLocation();
            } else {
                alert('Your browser does not support location service.');
            }
            
            this.fetchPlaces();

            new google.maps.places.Autocomplete(this.$els.origin);
        },
        isBrowserSupport: function () {
            if (navigator.geolocation) { // Try W3C Geolocation (Preferred)
                this.browserSupport = true;        
            } else { // Browser doesn't support Geolocation
                this.browserSupport = false;
            }

            return this.browserSupport;
        },
        fetchPlaces: function () {
            this.$http.get('/api/places', function (data) {
                for (var i=0; i<data.length; i++) {
                    this.destinations.push({
                        text: data[i].name,
                        value: data[i].latitude + ',' + data[i].longitude
                    });
                }
            });
        },
        getCurrentLocation: function () {
            var self = this;
            var geocoder = new google.maps.Geocoder;

            navigator.geolocation.getCurrentPosition(function (position) {
                self.currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                geocoder.geocode({
                    'location': self.currentLocation
                }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            self.route.origin = 'Your current position';
                            self.$refs.google.init(self.currentLocation);
                        }
                    }
                });

            }, function () {
                alert('Can not get your current location.');
            });
        },
        clearInput: function (e) {
            if (this.route.origin == 'Your current position') {
                this.route.origin = '';
            }
        },
        autoOrigin: function (e) {
            if (this.route.origin == '' && this.browserSupport) {
                this.route.origin = 'Your current position';
            }
        },
        navigateMe: function () {  
            var request = {
                origin: this.selectedOrigin,
                destination: this.selectedDestination,
                travelMode: google.maps.DirectionsTravelMode[this.route.travelMode],
                optimizeWaypoints: true,
                waypoints: this.selectedWaypoint,
                region: 'thailand'
            }

            this.$refs.google.getDirection(request);
        },
        addToWaypoint: function (place) {
            this.route.waypoints.push({ 
                name: place.name,
                stopover: true,
                location: place.geometry.location
            });
        },
        removeWaypoint: function (place) {
            this.route.waypoints.$remove(place);
        }
    }
}