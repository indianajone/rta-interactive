module.exports = {
    
    template: '<div class="google-map"></div>',

    components: {
        infoWindow: require('./InfoWindow')
    },

    props: {
        route: {}, 
        things: {
            type: Array,
            default: function () {
                return [];
            }
        }, 
        place: {
            type: Object,
            default: function () {
                return null;
            }
        }
    },

    data: function () {
        return {
            map: null,
            markers: [],
            nearby: [],
            services: {
                direction: null,
                place: null,
                renderer: null,
                boxer: null
            },
            infoWindow: null
        };
    },

    watch: {
        things: function (value) {
            this.$dispatch('map.refresh');
        },
        'route.origin': function (value) {
            this.clearMarkers();
            this.createMarker({
                geometry: {
                    location: value
                }
            });
            this.map.setCenter(value);
        }
    },

    events: {
        init: function (location) {
            this.init(location);
        },
        direction: function (request) {
            this.getDirection(request);
        },
        'add.nearby': function (places) {
            places.map((place) => {
                this.createArmyMarker(place);
            });
        },
        'remove.nearby': function () {
            this.nearby.map((marker) => {
                marker.setMap(null);
            });

            this.nearby = [];
        }
    },

    methods: {

        init: function (location) {

            var options = {
                center: location,
                zoom: 12
            };
  
            this.map = new google.maps.Map(this.$el, options);
            this.infoWindow = new google.maps.InfoWindow();
            this.services.direction = new google.maps.DirectionsService();
            this.services.place = new google.maps.places.PlacesService(this.map);
            this.services.boxer = new RouteBoxer();
            this.services.renderer = new google.maps.DirectionsRenderer({ 
                map: this.map,
                panel: document.getElementById('direction')
            });
            
            this.createMarker({
                geometry: {
                    location: location
                }
            });
            
            this.map.setCenter(location);
            
            google.maps.event.addDomListener(window, 'resize', () => {
                this.map.setCenter(location);
            });
        },

        getDirection: function (request) {
            var self = this;

            this.clearMarkers();
            this.services.direction.route(request, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {  
                    self.services.renderer.setDirections(result);
                    self.drawBoxes(result.routes);
                }
                else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        },

        drawBoxes: function (routes) {
            var self = this;
            var distance = 3;

            routes.map(function (route) {
                var boxes = self.services.boxer.box(route.overview_path, distance);
                self.findPlaces(boxes);
            });
        },

        findPlaces: function (areas) {
            if (this.things.length) {
                var self = this;
                areas.forEach(function (bound) {
                    var request = {
                        bounds: bound,
                        types: self.things
                    }

                    self.services.place.nearbySearch(request, function (results, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            results.forEach(function (place) {
                                self.createMarker(place);
                            });
                        }
                    });
                });
            }
        },  

        createArmyMarker: function (place) {
            var location = new google.maps.LatLng(place.latitude, place.longitude);
            var marker = new google.maps.Marker({
                title: place.title,
                map: this.map,
                icon: {
                    url: '/images/place-pin.png',
                    scaledSize: new google.maps.Size(22, 35)
                },
                position: location
            });

            marker.addListener('click', (e) => {
                this.setInfoWindow({
                    canAdd: true,
                    name: place.title,
                    location: location,
                }, marker);
            });

            this.nearby.push(marker);

            return marker;
        },

        createMarker: function (place) {
            var self = this;
            var marker = null;
            var markerAttributes = {
                map: this.map,
                position: place.geometry.location,
                icon: this.getPlaceIcon(place)
            };
             
            marker = new google.maps.Marker(markerAttributes);

            marker.addListener('click', function () {
                if (!place.place_id) {
                    self.setInfoWindow({
                        name: 'You are here.',
                        canAdd: false
                    }, marker);
                } else {
                    self.services.place.getDetails(place, function(place, status) {
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            self.setInfoWindow({
                                canAdd: true,
                                name: place.name,
                                description: place.vicinity,
                                location: place.geometry.location,
                                photos: place.photos
                            }, marker);
                        }
                    });
                }
            });

            this.markers.push(marker);
        },
        clearMarkers: function () {
            this.markers.map(function(marker) {
                marker.setMap(null);
            });
        },
        addWaypoint: function (place) {
            this.route.waypoints.push({ 
                name: place.name,
                stopover: true,
                location: place.location
            });

            this.$dispatch('map.refresh');
        },
        getPlaceIcon: function (place) {
            var icon = {
                url: place.icon,
                scaledSize: new google.maps.Size(10, 10)
            }

            if (!place.icon) {
                icon.url = 'http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png';
                icon.scaledSize = new google.maps.Size(20, 37);
            }

            return icon;
        },
        setInfoWindow: function (place, marker) {
            var infoWindowView = new this.$options.components.infoWindow;
                infoWindowView.$set('place', place);
                infoWindowView.$set('addToWaypoint', this.addWaypoint);

            this.infoWindow.setContent(infoWindowView.$el);
            this.infoWindow.open(this.map, marker);
        },
    }

}