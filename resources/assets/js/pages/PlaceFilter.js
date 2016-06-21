module.exports = {

    props: ['places', 'openModal'],

    data: function () {
        return {
            filteredBy: [],
            open: true,
            noResult: false
        };
    },

    ready: function () {
        setTimeout(() => {
            this.open = false;
        }, 700);
    },

    computed: {
        noResult: function () {
            return  _.filter(this.places, (place) => {
                return _.intersection(
                            _.toArray(place.categories), 
                            _.flatten(this.filteredBy.map(Number))
                        ).length === this.filteredBy.length;
            }).length === 0;
        }
    },

    methods: {
        toggle: function () {
            this.open = !this.open;
        }
    }
}