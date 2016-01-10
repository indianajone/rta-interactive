export default {
    
    template: require('./templates/modal.html'),

    props: {
        show: {
            type: Boolean,
            required: true,
            twoWay: true    
        }
    },

    methods: {
        close: function (e) {
            if (e.target.parentElement === this.$el) {
                this.show = false;
            }
        }
    }
}