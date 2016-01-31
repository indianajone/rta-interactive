require('../vendor/dropdown-checkbox');

export default {

    bind: function () {
        $(this.el).selectpicker();
    },

    unbind: function () {
        $(this.el).selectpicker('destroy');
    }
}