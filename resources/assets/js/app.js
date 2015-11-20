var Vue = require('vue');

Vue.use(require('vue-resource'));
// Vue.config.debug = true;

new Vue({
    el: '#app',

    data: {
        showModal: false
    },

    components: {
        interactiveMap: require('./components/InteractiveMap'),
        modal: require('./components/Modal'),
        search: require('./components/Search')
    }    
});