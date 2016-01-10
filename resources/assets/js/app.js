require('./core/bootstrap');
require('./vendor/lity');

Vue.component('modal', require('./components/Modal'));

new Vue({
    el: '#app',

    data: {
        modals: {
            login: {
                show: false,
                tab: 'login'
            }
        }
    },

    methods: {
        openModal: function (name, tab) {
            this.modals[name].show = true;
            if (tab) {
                this.modals[name].tab = tab;
            }
        }
    },

    directives: {
        slick: require('./components/CarouselSlick.js')
    },

    components: {
        placeFilter: require('./pages/PlaceFilter'),
        interactiveMap: require('./components/InteractiveMap'),
        search: require('./components/Search'),
        panorama: require('./components/Panorama'),
        login: require('./components/Login'),
        logout: require('./components/Logout'),
    }
});