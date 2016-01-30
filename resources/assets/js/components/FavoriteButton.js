export default {

    template: `<a @click.prevent="action"><i :class="['fa', 'fa-lg', star]"></i></a>`,

    props: ['place', 'favorited'],

    computed: {
        star: function () {
            return !this.favorited ? 'fa-star-o' : 'fa-star';
        }
    },

    methods: {
        action: function () {
            this.favorited ? this.unfavorite() : this.favorite();
        },

        favorite: function () {
            this.$http.post('/api/favorites/' + this.place)
                .then((data) => {
                    this.favorited = true;
                });
        },

        unfavorite: function () {
            this.$http.delete('/api/favorites/' + this.place)
                .then((data) => {
                    this.favorited = false;
                });
        }
    }
}