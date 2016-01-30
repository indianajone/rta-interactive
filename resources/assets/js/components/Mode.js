module.exports = {
    
    template: require('./templates/mode.html'),

    props: ['mode'],

    data: function () {
        return {
            types: [{
                'icon': 'car',
                'value': 'DRIVING'
            },{
                'icon': 'bus',
                'value': 'TRANSIT'
            }, {
                'icon': 'male',
                'value': 'WALKING'
            }]
        }
    },

    methods: {
        onChange: function (selected) {
           this.mode = selected.value;
           this.$dispatch('map.refresh');
        }
    }
}