module.exports = {

    props: ['selected', 'categories', 'places'],

    computed: {
        destinations: function () {
            return this.places.map( place => {
                return {
                    title: place.title,
                    location: this.getLocation(place),
                    categories: this.getCategories(place)
                }
            });
        }
    },

    watch: {
        selected: function () {
            $(this.$els.destination).selectpicker('refresh');
        },
        filteredBy: function () {
            $(this.$els.destination).selectpicker('refresh');
        }
    },

    data: function () {
        return {
            filteredBy: []
        }
    },

    methods: {

        getCategories(place) {
            
            if (!place.categories) {
                return [];
            }

            return place.categories.map( category => category.id );
        },

        getLocation(place) {
            return place.latitude + ',' + place.longitude;
        }
    }
}