var Vue = require('vue');

Vue.use(require('vue-resource'));
// Vue.config.debug = true;

new Vue({
    el: '#app',

    components: {
        interactiveMap: require('./components/InteractiveMap'),
        search: require('./components/Search')
    }    
});