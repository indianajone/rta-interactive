var Vue = require('vue');

Vue.use(require('vue-resource'));
Vue.config.debug = true;

new Vue({
    el: '#app',

    components: {
        homeView: require('./views/home')
    },

    data: {
        currentView: 'home-view'
    }
    
});