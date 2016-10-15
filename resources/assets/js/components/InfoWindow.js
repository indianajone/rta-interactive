module.exports = {

    template: require('./templates/info-window.html'),

    el: function () {
        return document.createElement('div');
    },
      
    data: function () {
        return {
            place: {},
            addWaypoint: null,
            marker: null
        }
    },

    computed: {
        hasPhoto: function () {
            return this.place.photos && this.place.photos.length;
        },
        photo: function () {
            console.log(typeof this.place.photos);
            if (!this.hasPhoto) {
                return;
            }

            if (typeof this.place.photos === 'string') {
                return this.place.photos;
            }

            return this.place.photos[0].getUrl({
                maxWidth: 50,
                maxHeight: 50
            });
        }
    },

    methods: {
        addToWaypoint: function () {
            this.addWaypoint(this.place);
            this.marker.setMap(null);
        }
    }
}