module.exports = {

    template: require('./origin.template.html'),

    props: ['origin'],

    data: function () {
        return {
            currentLocation: null,
            currentLocationText: 'Your current position',
        }
    },

    ready: function () {
        var self = this;
        var autoComplete = new google.maps.places.Autocomplete(this.$els.origin, {
            componentRestrictions: {country: 'th'}
        });

        autoComplete.addListener('place_changed', function () {
            self.onChanged(autoComplete.getPlace());
        });
    },

    computed: {
        value: function () {
            if (typeof this.origin == 'object') {
                this.currentLocation = this.origin;
                return this.currentLocationText;
            }

            return this.origin;
        }
    },

    methods: {
        onBlur: function () {
            if (this.origin == '' && this.currentLocation) {
                this.origin = this.currentLocation;
                return;
            }

            this.origin = this.value;
        },
        onFocus: function () {
           if (this.value == this.currentLocationText) {
                this.origin = '';
           }
        },
        onChanged: function (place) {
            this.origin = place.name;
            this.$dispatch('map.refresh');
        }
    }

}