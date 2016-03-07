var PhotoSwipe = require('photoswipe');
var PhotoSwipeUI_Default = require('photoswipe/dist/photoswipe-ui-default');
export default {
    template: require('./templates/gallery.html'),

    props: ['photos', 'buttons'],

    data: function () {
        return {
            gallery: null,
            items: []
        };
    },

    ready: function () {
        this.items = this.parseThumbnailElements();
    },

    methods: {

        openPhotoSwipe: function (index) {
            var pswp = $('.pswp').get(0);
            var options = {
                index: index,
                galleryUID: this._uid,
                getThumbBoundsFn: this.getThumbBounds,
                // shareButtons: this.getShareButtons
            }

            this.gallery = new PhotoSwipe(pswp, PhotoSwipeUI_Default, this.items, options);
            this.gallery.init();
        },

        getShareButtons: function () {
            console.log(arguments);
            return [
                { id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}' }
            ];
        },

        getThumbBounds: function (index) {
            var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
            var  rect = this.items[index].el.getBoundingClientRect();
        
            return {
                x:rect.left, y:rect.top + pageYScroll, w:rect.width
            };
        },

        parseThumbnailElements: function () {
            var $els = $(this.$el).find('.place__image > a');
            var items = [];

            $els.each(function (i) {
                var $el = $(this);
                var size = $el.data('size').split('x');

                items.push({
                    el: this,
                    src: $el.attr('href'),
                    w: size[0],
                    h: size[1]
                });
            });

            return items;
        },

        parse: function (str) {
            if (typeof str === 'string') {
                return JSON.parse(str);
            }

            return str;
        }
    }
}