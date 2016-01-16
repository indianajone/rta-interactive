
export default {

    template: require('./templates/readmore.html'),

    props: ['maxHeight', 'text', 'show'],

    data: function () {
        return {
            style: {
                height: 'auto',
                overflow: 'hidden'
            }
        }
    },

    ready: function () {
        if (this.show) {
            this.style.height = this.maxHeight + 'px';
        }
    },

    methods: {
        toggle: function () {
           if (this.style.height !== 'auto') {
                this.style.height = 'auto';
           } else {
                this.style.height = this.maxHeight + 'px';
           }
        }
    }

}