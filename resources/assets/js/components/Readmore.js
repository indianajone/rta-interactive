
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

    computed: {
        isOpen: function () {
            return this.style.height === 'auto';
        },
        body: function () {
            var text = JSON.parse(this.text);
            return this.isOpen ? text[1] : text[0];
        }
    },

    methods: {
        toggle: function () {
           this.style.height = !this.isOpen ? 'auto' : this.maxHeight + 'px';
        }
    }

}