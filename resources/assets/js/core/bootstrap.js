/*
 * Load Vue & Vue's components.
 */
if (window.Vue === undefined) {
    window.Vue = require('vue');
}

Vue.config.debug = true;
Vue.use(require('vue-resource'));
Vue.use(require('vue-chunk'));

/*
 * Load Underscore, used for map / reduce on arrays.
 */
if (window._ === undefined) {
    window._ = require('underscore');
}

/*
 * Load jQuery and Bootstrap jQuery, used for front-end interaction.
 */
if (window.$ === undefined || window.jQuery === undefined) {
    window.$ = window.jQuery = require('jquery');
}

if (window.Rta === undefined) {
    window.Rta = {};
}

require('bootstrap-sass/assets/javascripts/bootstrap');