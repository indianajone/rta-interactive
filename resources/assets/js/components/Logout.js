export default {

    template: '<a @click="logout" class="navbar-nav__link">{{ text }}</a>',

    props: ['text'],

    methods: {
        logout: function () {
            this.$http.delete('/api/logout').then((data) => {
                window.location.reload();
            })
        }
    }

}