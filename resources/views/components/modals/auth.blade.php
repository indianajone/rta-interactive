<login :show.sync="modals.login.show" :tab.sync="modals.login.tab" inline-template>
    <modal :show.sync="show">
        <div class="modal-header">
            <ul class="nav nav-tabs" role="tablist">
                <li :class="{'active' : tab == 'login'}">
                    <a @click="filp('login')" href="#login">
                        {{ trans('form.heading.login') }}
                    </a>
                </li>
                <li :class="{'active' : tab == 'register'}">
                    <a @click="filp('register')" href="#register">
                        {{ trans('form.heading.register') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="modal-body tab-content">
            <div class='alert alert-danger' v-if='errors.length > 0'>
                <ul>
                    <li v-for='error in errors'>@{{ error }}</li>
                </ul>
            </div>
            <div v-show="tab == 'login'">
                <form class="form" @keyup.enter.prevent="login">
                    <div class="form-group">
                        <label for="email" class="sr-only">{{ trans('form.inputs.email') }}</label>
                        <input v-model="email" type="email" name="email" class="form-control" placeholder="{{ trans('form.inputs.email') }}" >
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">{{ trans('form.inputs.password') }}</label>
                        <input v-model="password" type="password" name="password" class="form-control" placeholder="{{ trans('form.inputs.password') }}">
                    </div>
                </form>
                <button @click="login" type="button" class="btn btn-block btn-success">
                    {{ trans('form.buttons.login') }}
                </button>
                <hr/>
                <button @click="facebook" type="button" class="btn btn-block btn-social btn-facebook"> 
                    <i class="fa fa-facebook"></i>
                    {{ trans('form.buttons.facebook') }}
                </button>
                <button @click="google" type="button" class="btn btn-block btn-social btn-google"> 
                    <i class="fa fa-google-plus"></i>
                    {{ trans('form.buttons.google') }}
                </button>
            </div>
            <div v-show="tab == 'register'">
                <form class="form" @keyup.enter.prevent="register">
                    <div class="form-group">
                        <label for="name" class="sr-only">{{ trans('form.inputs.name') }}</label>
                        <input v-model="name" type="name" name="name" class="form-control" placeholder="{{ trans('form.inputs.name') }}" >
                    </div> 
                    <div class="form-group">
                        <label for="email" class="sr-only">{{ trans('form.inputs.email') }}</label>
                        <input v-model="email" type="email" name="email" class="form-control" placeholder="{{ trans('form.inputs.email') }}" >
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">{{ trans('form.inputs.password') }}</label>
                        <input v-model="password" type="password" name="password" class="form-control" placeholder="{{ trans('form.inputs.password') }}">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="sr-only">{{ trans('form.inputs.password_confirmation') }}</label>
                        <input v-model="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('form.inputs.password_confirmation') }}">
                    </div>
                    <div class="form-group">
                        <button @click="register" type="button" class="btn btn-block btn-success">
                            {{ trans('form.buttons.register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </modal>
</login>