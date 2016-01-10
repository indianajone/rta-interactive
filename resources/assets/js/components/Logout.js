export default {

    template: '<button @click="logout" class="navbar-nav__link">{{ text }}</button>',

    props: ['text'],

    methods: {
        logout: function () {
            this.$http.delete('/api/logout').then((data) => {
                window.location.reload();
            })
        }
    }

}