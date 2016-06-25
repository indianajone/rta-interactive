module.exports = {

    components: {
        googleMap: require('./GoogleMap'),
        googlePanel: require('./GooglePanel'),
        origin: require('./Origin'),
        destinations: require('./Destination'),
        mode: require('./Mode'),
        waypoint: require('./Waypoint')
    },

    props: {
        things: {
            type: Array,
            default: () => []
        },
        place: {
            type: Object,
            default: () => null
        },
        nears: {
            type: Array
        },
        nearby: { 
            type: Boolean,
            default: () => false
        }
    },

    data: function () {
        return {
            currentLocation: {
                lat: 13.724600, 
                lng: 100.6331108 
            },
            route: { origin: '', destination: '', travelMode: 'DRIVING', waypoints: [] },
            panel: null
        }
    },

    ready: function () {
        this.init();
    },

    events: {
        'map.refresh': function () {
            this.navigateMe();
        }
    },

    watch: {
        nearby: function (show) {
            if(show && this.nears) {
                this.$broadcast('add.nearby', this.nears);
            } else {
                this.$broadcast('remove.nearby');
            }
        }
    },

    computed: {
        browserSupport: function () {
            return navigator.geolocation ? true : false;
        },
        selectedThings: function () {
            if (this.route.travelMode !== 'DRIVING') {
                return [];
            }

            return this.things.filter( thing => {
                    return thing.selected
                })
                .map( thing => {
                    return thing.value;
                });
        },
        selectedWaypoint: function () {
            return this.route.waypoints.map( place => {
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

            if (this.place.latitude && this.place.longitude) {
                this.route.destination = this.place.latitude + ',' + this.place.longitude;
            }

            this.$broadcast('init', this.currentLocation);  
            this.$broadcast('add.nearby', this.nears);      
        },
        getCurrentLocation: function () {
    
            let geocoder = new google.maps.Geocoder;

            navigator.geolocation.getCurrentPosition( position => {
                this.currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                geocoder.geocode({
                    'location': this.currentLocation
                }, (results, status) => {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            this.route.origin = this.currentLocation;
                            this.navigateMe();
                        }
                    }
                });

            }, () => {
                alert('Can not get your current location.');
            });
        },
        navigateMe: function () {  
            let request = {
                origin: this.route.origin,
                destination: this.route.destination,
                travelMode: google.maps.DirectionsTravelMode[this.route.travelMode],
                // optimizeWaypoints: true,
                provideRouteAlternatives: true,
                waypoints: this.selectedWaypoint,
                region: 'thailand'
            }

            if (this.route.origin && this.route.destination) {
                this.$broadcast('direction', request);
            }
        }
    }
}