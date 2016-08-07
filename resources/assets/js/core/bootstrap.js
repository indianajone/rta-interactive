/*
 * Check browser support.
 */

let ua = navigator.userAgent;
let re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
let ie = false;
let version = 0;

if (re.exec(ua) != null) {
    ie = true;
    version = parseFloat( RegExp.$1 );
}

if(ie && version <= 8) {
    window.location = '/supports';
}   


/*
 * Load Vue & Vue's components.
 */
if (window.Vue === undefined) {
    window.Vue = require('vue');
}

Vue.config.debug = true;
Vue.use(require('vue-resource'));
Vue.use(require('vue-chunk'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf_token').getAttribute('value');

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