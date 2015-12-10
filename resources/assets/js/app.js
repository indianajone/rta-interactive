require('./core/bootstrap');
require('./vendor/lity');

new Vue({
    el: '#app',

    directives: {
        slick: require('./components/CarouselSlick.js')
    },

    components: {
        placeFilter: require('./pages/PlaceFilter'),
        interactiveMap: require('./components/InteractiveMap'),
        search: require('./components/Search'),
        panorama: require('./components/Panorama'),
    }
});