module.exports = {

    props: ['places'],

    data: function () {
        return {
            filteredBy: []
        };
    },

    filters: {
        inCategory: function (places) {

            if (this.filteredBy.length == 0) {
                return places;
            }
            var self = this;
            var result = _.filter(places, function (place) {
                return _.intersection(
                            _.toArray(place.categories), 
                            self.filteredBy.map(Number)
                        ).length > 0;
            });

            return result;
        }
    },

    methods: {

    }

}