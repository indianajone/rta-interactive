require('../vendor/dropdown-checkbox');

export default {

    bind: function () {
        $(this.el).selectpicker({
            mobile: true
        });
    },

    unbind: function () {
        $(this.el).selectpicker('destroy');
    }
}