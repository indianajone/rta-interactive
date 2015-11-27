module.exports = {

    props: ['places'],

    data: function () {
        return {
            filteredBy: []
        };
    },

    filters: {
        inCategory: function (array) {

            if (this.filteredBy.length == 0) {
                return array;
            }

            var matches = [];
            var self = this;

            array.forEach(function (obj) {
                if (self.isMatch(obj.categories[0])) {
                    matches.push(obj);
                }
            });

            return matches;
        }
    },

    methods: {

        isMatch: function (needle) {
            
            for (var i in this.filteredBy) {
                if (this.filteredBy[i] == needle) return true;
            }

            return false;
        },

        submit: function () {

        }
    }

}