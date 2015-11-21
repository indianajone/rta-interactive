var Vue = require('vue');

Vue.config.debug = true;
Vue.use(require('vue-resource'));

Vue.component('interactive-map', require('./components/InteractiveMap'));
Vue.component('google-map', require('./components/GoogleMap'));
Vue.component('origin', require('./components/Origin'));
Vue.component('destinations', require('./components/Destination'));
Vue.component('mode', require('./components/Mode'));
Vue.component('waypoint', require('./components/Waypoint'));
Vue.component('modal', require('./components/Modal'));
Vue.component('search', require('./components/Search'));

new Vue({
    el: '#app',
    data: {
        showModal: false
    }    
});