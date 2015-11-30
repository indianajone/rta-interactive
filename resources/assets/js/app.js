require('./core/bootstrap');

new Vue({
    el: '#app',
    
    data: {
        showModal: false
    },

    components: {
        placeFilter: require('./pages/PlaceFilter'),
        interactiveMap: require('./components/InteractiveMap'),
        modal: require('./components/Modal'),
        search: require('./components/Search'),
        slideshow: require('./components/SlideShow'),
        panorama: require('./components/Panorama')
    }
});