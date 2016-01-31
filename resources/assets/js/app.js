require('./core/bootstrap');
require('./vendor/lity');

Vue.component('modal', require('./components/Modal'));
Vue.component('favoriteButton', require('./components/FavoriteButton'));
Vue.component('socialShare', require('./components/SocialShare'));

Vue.directive('slick', require('./directives/CarouselSlick.js'));
Vue.directive('socials', require('./directives/JsSocials.js'));
Vue.directive('dropdownCheckbox', require('./directives/DropdownCheckbox.js'));

Vue.filter('inCategory', function (places) {
    if (this.filteredBy.length == 0) {
        return places;
    }
    var self = this;
    var result = _.filter(places, function (place) {
        return _.intersection(
                    _.toArray(place.categories), 
                    self.filteredBy.map(Number)
                ).length === self.filteredBy.length;
    });

    return result;
});

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

    components: {
        placeFilter: require('./pages/PlaceFilter'),
        interactiveMap: require('./components/InteractiveMap'),
        search: require('./components/Search'),
        panorama: require('./components/Panorama'),
        login: require('./components/Login'),
        logout: require('./components/Logout'),
        readmore: require('./components/Readmore')
    }
});