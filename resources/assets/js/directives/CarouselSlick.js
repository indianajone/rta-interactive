require('slick-carousel');

module.exports = {

    params: ['options'],

    bind: function () {
        var options = _.extend({
            dots: true
        }, this.params.options);

        $(this.el).slick(options);
    },
    unbind: function () {
       $(this.el).slick('unslick');
    }
}