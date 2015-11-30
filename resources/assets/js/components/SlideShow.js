var Flickity = require('flickity');

module.exports = {

    template: '<div :class=[type]>'+
              '    <div v-for="slide in slides" :class="[type + \'__item\']">'+
              '        <img :src="slide.src" alt="{{ slide.title }}">'+
              '        <span v-if="type == \'banner\'">{{ slide.title }}</span>'+
              '    </div>'+
              '</div>',

    props: ['src', 'options', 'type'],

    data: function () {
        return {
            default: {
                imagesLoaded: true,
                setGallerySize: false
            },
            slides: [
                { title: 'bangpu', src: '/uploaded/2015/11/09/bangpu.jpg' },
                { title: 'bangpu2', src: '/uploaded/2015/11/15/bangpu.jpg' }
            ]
        };
    },

    created: function () {
        if (this.src) {
            this.clear();
            this.slides = this.src;
        }
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