module.exports = {

    props: ['selected', 'categories', 'places'],

    filters: {
        children: function (places) {
            if (!this.filteredBy.length) return places;

            return _.filter(places, (place) => {
                return this.isInCategory(place.categories);
            });
        }
    },

    computed: {
        destinations: function () {
            return this.places.map((place) => {
                return {
                    title: place.title,
                    location: place.latitude + ',' + place.longitude,
                    categories: place.categories.map((category) => {
                        return category.id
                    })
                }
            });
        }
    },

    watch: {
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
        isInCategory: function (categories) {
            return _.intersection(
                _.toArray(categories), 
                _.flatten(_.toArray(this.filteredBy))
            ).length > 0;
          
        }
    }
}