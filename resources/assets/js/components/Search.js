module.exports = {

    template: require('./search.template.html'),

    data: function () {
        return {
            query: '',
            results: []
        };
    },

    watch: {
        query: function () {
            this.search();
        }
    },

    filters: {
        highlight: function (value) {
            var str = value;
            var query = this.query.replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&");
            var specialChar = 'ุูึํัี๊่๋้็ิื์';
            var regex = new RegExp('('+ query + ')[' + specialChar + ']?', 'g');
            
            if (this.query.length) {
                str = str.replace(regex, '<span class="search__keyword">$&</span>');
            }
            
            return str;
        }
    },

    methods: {
        search: function () {
            this.$http.get('/api/places?q=' + this.query, function (data) {
                this.results = data;
            }.bind(this));
        },
        go: function (rel) {
            window.location.href = rel;
        },  
        reset: function () {
            this.query = '';
            this.results = [];
        }
    }
 
}