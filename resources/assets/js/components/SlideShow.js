var Flickity = require('flickity');

module.exports = {

    template: '<div :class=[type]>'+
              '    <div v-for="slide in slides" :class="[type + \'__item\']">'+
              '        <img :src="slide.src" alt="{{ slide.title }}">'+
              '        <span v-if="type == \'banner\'">{{ slide.title }}</span>'+
              '    </div>'+
              '</div>',

    props: [ 'type', 'options' ],

    data: function () {
        return {
            default: {
                imagesLoaded: true,
                resize: false,
                setGallerySize: false
            },
            slides: []
        };
    },

    created: function () {
        this.slides = Rta.photos || this.src || [];
    },

    ready: function () {  
        var flickity = new Flickity(this.$el, _.extend(this.default, this.options));
    },

    methods: {
        clear: function () {
            this.slides = [];
        }
    }
}