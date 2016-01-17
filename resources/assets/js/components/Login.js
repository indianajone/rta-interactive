export default {

    template: '<modal :show.sync=show><slot></slot></modal>',
    
    props: ['show', 'tab'],

    data: function () {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            errors: [],
            message: ''
        }
    },

    methods: {

        filp: function (tab) {
            this.tab = tab;
            this.email = '';
            this.password = '';
            this.password_confirmation = '';
            this.errors = [];
        },

        login: function () {
            
            var credentials = { email: this.email, password: this.password };
            
            this.$http.post('/api/login', credentials)
                    .success((data) => {
                        window.location.reload();
                    })
                    .error((errors) => {
                        this.password = '';
                        this.errors = _.flatten(_.toArray(errors));
                    });
        },

        register: function () {

            var data = { 
                name: this.name,
                email: this.email, 
                password: this.password 
            };

            this.$http.post('/api/register', data)
                    .success((data) => {
                        window.location.reload();
                    })
                    .error((errors) => {
                        this.password = '';
                        this.password_confirmation = '';
                        this.errors = _.flatten(_.toArray(errors));
                    });
        },

        facebook: function () {
            window.location.href = '/api/login/facebook';
        },

        google: function () {
            window.location.href = '/api/login/google';
        }, 

        forgetPassword: function () {
            this.errors = [];
            this.$http.post('/api/password', {email: this.email})
                    .success((data) => {
                        this.message = data.status;
                    })
                    .error((errors) => {
                        this.email = '';
                        this.errors = _.flatten(_.toArray(errors));
                    });
        }
    }

}