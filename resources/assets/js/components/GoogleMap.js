module.exports = {
    
    template: require('./google-map.template.html'),

    components: {
        infoWindow: require('./InfoWindow')
    },

    props: {
        route: {}, 
        things: {}, 
        places: {
            type: Array
        }
    },

    data: function () {
        return {
            map: null,
            markers: [],
            services: {
                direction: null,
                renderer: null,
                place: null,
                boxer: new RouteBoxer()
            },
            infoWindow: null,
            location: {
                lat: 13.724600, 
                lng: 100.6331108 
            }
        }
    },

    ready: function () {
        var options = {
            center: this.location,
            zoom: 12
        };
        
        this.map = new google.maps.Map(this.$el, options);
    },

    watch: {
        things: function (value) {
            this.$dispatch('map.refresh');
        }
    },

    methods: {

        getDirection: function (request) {
            var self = this;

            this.clearMarkers();
            this.services.direction.route(request, function (result, status) {
                console.log(result);
                if (status == google.maps.DirectionsStatus.OK) {
                    // for (var i = 0, len = result.routes.length; i < len; i++) {
                    //     var renderer = new google.maps.DirectionsRenderer({
                    //         map: self.map,
                    //         directions: result,
                    //         routeIndex: i,
                    //         draggable: true,
                    //     });    
                    // }
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
        
        init: function (location) {
            this.location = location;
            this.infoWindow = new google.maps.InfoWindow();
            this.services.direction = new google.maps.DirectionsService();
            this.services.place = new google.maps.places.PlacesService(this.map);
            this.services.renderer = new google.maps.DirectionsRenderer({ 
                map: this.map,
                // panel: this.$els.panel
            });
            
            this.createMarker({
                geometry: {
                    location: this.location
                }
            });

            if (this.places) {
                this.places.map((place) =>  {
                    place.map = this.map;
                    this.markers.push(this.createArmyMarker(place));
                });
            }
            
            this.map.setCenter(this.location);
            
            google.maps.event.addDomListener(window, 'resize', function() {
                this.map.setCenter(this.location);
            }.bind(this));
        },

        createArmyMarker: function (place) {
            var marker = new google.maps.Marker({
                title: place.title,
                map: this.map,
                icon: {
                    url: place.icon,
                    scaledSize: new google.maps.Size(22, 35)
                },
                position: place.geometry.location
            });

            marker.addListener('click', (e) => {
                this.setInfoWindow({
                    canAdd: false,
                    name: place.title,
                    location: place.geometry.location,
                }, marker);
            });

            return marker;
        },

        createMarker: function (place) {
            var self = this;
            var marker = null;
            var markerAttributes = {
                map: this.map,
                position: place.geometry.location
            };

            if (place.icon) {
                markerAttributes.icon = this.getPlaceIcon(place);
            }
             
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
                icon.url = 'http://maps.gstatic.com/mapfiles/circle.png';
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