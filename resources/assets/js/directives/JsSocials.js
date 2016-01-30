require('../vendor/js-social');

export default {

    params: ['url'],

    bind: function () {
        $(this.el)
            .popover({
                placement: 'bottom',
                html: true,
                content: function () {
                    return '<div class="share-buttons></div>';
                },
                template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
            })
            .on('inserted.bs.popover', function () {
                $(this.el).next('div').find('.popover-content').jsSocials({
                    url: this.params.url,
                    shares: ['facebook', 'googleplus', 'email'],
                    showLabel: false,
                    showCount: false,
                });
            }.bind(this));
    },

    unbind: function () {
        $(this.el).popover('destroy');
    }
}