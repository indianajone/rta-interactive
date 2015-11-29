var Vue = require('vue');

Vue.config.debug = true;
Vue.use(require('vue-resource'));
Vue.use(require('vue-chunk'));

if (window._ === undefined) {
    window._ = require('underscore');
}

if (window.$ === undefined || window.jQuery === undefined) {
    window.$ = window.jQuery = require('jquery');
}

require('bootstrap-sass/assets/javascripts/bootstrap');

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
        panorama: require('./components/Panorama')
    }
});