module.exports = {

    template: require('./search.template.html'),

    data: function () {
        return {
            query: '',
            results: {
                search: [],
                recommended: []
            }
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

    computed: {
        noResults: function() {
            return this.query.length && !this.results.search.length;
        }
    },

    methods: {
        search: function () {
            this.$http.get('/api/search?q=' + this.query, function (data) {
                this.results.search = data.search;
                this.results.recommended = data.recommended;
            }.bind(this));
        },
        go: function (rel) {
            window.location.href = rel;
        },  
        reset: function () {
            this.query = '';
            this.results = {
                search: [],
                recommended: []
            }
        }
    }
 
}