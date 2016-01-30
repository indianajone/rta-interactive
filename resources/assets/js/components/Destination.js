module.exports = {
    
    template: require('./templates/destination.html'),

    props: ['selected'],

    data: function () {
        return {
            destinations: [{ text: 'Please select your destination', value: '' }]
        }
    },

    ready: function () {
        this.fetchPlaces();
    },

    methods: {
        fetchPlaces: function () {
            this.$http.get('/api/places', function (data) {
                for (var i=0; i<data.length; i++) {
                    this.destinations.push({
                        text: data[i].name,
                        value: data[i].latitude + ',' + data[i].longitude
                    });
                }
            });
        }
    }
}