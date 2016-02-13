var panorama = require('../vendor/jquery.panorama-viewer.js');

module.exports = {
    template: '<div class="panorama lity-hide"><img :src="src"></div>',

    props: ['src'],

    ready: function () {
        $(this.$el).panorama_viewer({
            direction: 'horizontal',
            repeat: true,
            overlay: false,
            resize: true
        });
    }
}