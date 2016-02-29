
export default {

    template: require('./templates/readmore.html'),

    props: ['maxHeight', 'text', 'show'],

    data: function () {
        return {
            style: {
                height: 'auto'
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
            console.log(this.text);
            var text = JSON.parse(this.text);
            console.log(text);
            return this.isOpen ? text[1] : text[0];
        }
    },

    methods: {
        toggle: function () {
           this.style.height = !this.isOpen ? 'auto' : this.maxHeight + 'px';
        }
    }

}