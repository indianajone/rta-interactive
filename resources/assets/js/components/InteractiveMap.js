module.exports = {

    components: {
        googleMap: require('./GoogleMap'),
        origin: require('./Origin'),
        destinations: require('./Destination'),
        mode: require('./Mode'),
        waypoint: require('./Waypoint')
    },

    props: {
        'things': {
            type: Array
        }
    },

    events: {
        'map.refresh': function () {
            this.navigateMe();
        }
    },

    data: function () {
        return {
            marginBottom: 50,
            currentLocation: null,
            route: { origin: '', destination: '', travelMode: 'DRIVING', waypoints: [] }
        }
    },

    ready: function () {
        this.init();
    },

    computed: {
        browserSupport: function () {
            return navigator.geolocation ? true : false;
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
            if (this.browserSupport) {
                this.getCurrentLocation();
            } else {
                alert('Your browser does not support location service.');
            }

            window.addEventListener('resize', this.onResize);
        },
        onResize: function () {
            this.width = window.innerWidth;
            this.height = window.innerHeight - this.marginBottom;
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
                            self.route.origin = self.currentLocation;
                            self.$refs.google.init(self.currentLocation);
                        }
                    }
                });

            }, function () {
                alert('Can not get your current location.');
            });
        },
        navigateMe: function () {  
            var request = {
                origin: this.route.origin,
                destination: this.route.destination,
                travelMode: google.maps.DirectionsTravelMode[this.route.travelMode],
                // optimizeWaypoints: true,
                provideRouteAlternatives: true,
                waypoints: this.selectedWaypoint,
                region: 'thailand'
            }

            if (this.route.origin && this.route.destination) {
                this.$refs.google.getDirection(request);
            }
        }
    }
}