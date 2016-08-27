require('../vendor/RouteBoxer');

module.exports = {
    
    template: '<div class="google-map"></div>',

    components: {
        infoWindow: require('./InfoWindow')
    },

    props: {
        route: {}, 
        things: {
            type: Array,
            default: () => []
        }, 
        place: {
            type: Object,
            default:  () => null
        }
    },

    data: function () {
        return {
            map: null,
            distance: 3, 
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
            places.map(place => {
                this.createArmyMarker(place);
            });
        },
        'remove.nearby': function () {
            this.nearby.map(marker => {
                marker.setMap(null);
            });

            this.nearby = [];
        }
    },

    methods: {

        init: function (location) {

            let RouteBoxer = window.RouteBoxer;
            let options = {
                center: location,
                zoom: 6
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
        
            this.clearMarkers();
            this.services.direction.route(request, (result, status) => {
                if (status == google.maps.DirectionsStatus.OK) {  
                    this.services.renderer.setDirections(result);
                    this.drawBoxes(result.routes);
                }
                else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        },

        drawBoxes: function (routes) {
            routes.map(route => {
                this.findPlaces(
                    this.services.boxer.box(route.overview_path, this.distance)
                );
            });
        },

        findPlaces: function (areas) {
            if (this.things.length) {
                areas.forEach( bound => {
                    let request = {
                        bounds: bound,
                        types: this.things
                    }

                    this.services.place.nearbySearch(request, (results, status) => {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            results.forEach( place => {
                                if(this.canAdd(place.name)) {
                                    this.createMarker(place);
                                }
                            });
                        }
                    });
                });
            }
        },  

        createArmyMarker: function (place) {

            let location = new google.maps.LatLng(place.latitude, place.longitude);
            let marker = new google.maps.Marker({
                title: place.title,
                map: this.map,
                icon: {
                    url: '/images/place-pin.png',
                    scaledSize: new google.maps.Size(22, 35)
                },
                position: location
            });

            marker.addListener('click', e => {
                this.setInfoWindow({
                    canAdd: this.canAdd(place.title),
                    name: place.title,
                    description: place.description,
                    location: location,
                }, marker);
            });

            this.nearby.push(marker);

            return marker;
        },

        createMarker: function (place) {
            
            let marker = new google.maps.Marker({
                map: this.map,
                position: place.geometry.location,
                icon: this.getPlaceIcon(place)
            });
             

            marker.addListener('click', e => {
                if (!place.place_id) {
                    this.setInfoWindow({
                        name: 'You are here.',
                        canAdd: false
                    }, marker);
                } else {
                    this.services.place.getDetails(place, (place, status) => {
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            this.setInfoWindow({
                                canAdd: this.canAdd(place.name),
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

        canAdd: function(placeName) {
            let can = true;
            
            this.route.waypoints.map( waypoint => {
                if (waypoint.name === placeName) {
                    can = false;
                }
            });

            return can;
        },

        clearMarkers: function () {
            this.markers.map( marker => {
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
            let icon = {
                url: place.icon,
                scaledSize: new google.maps.Size(10, 10)
            }

            if (!place.icon) {
                icon.url = 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png';
                icon.scaledSize = new google.maps.Size(20, 37);
            }

            return icon;
        },

        setInfoWindow: function (place, marker) {
            let infoWindowView = new this.$options.components.infoWindow;
                infoWindowView.$set('place', place);
                infoWindowView.$set('marker', marker);
                infoWindowView.$set('addToWaypoint', this.addWaypoint);

            this.infoWindow.setContent(infoWindowView.$el);
            this.infoWindow.open(this.map, marker);
        },
    }

}