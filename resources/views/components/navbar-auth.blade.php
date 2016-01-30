<ul class="nav navbar-nav">
    @if(!Auth::check())
        <li>
            <button @click="openModal('login', 'login')" class="navbar-nav__link">{{ trans('menu.login') }}</button>
        </li>
        <li>
            <button @click="openModal('login', 'register')" class="navbar-nav__link">{{trans('menu.register') }}</button>
        </li>
        <li>
            <button  @click="openModal('login', 'forget')" class="navbar-nav__link">{{trans('menu.forget_password') }}</button>
        </li>
    @else 
        <li>
            <button class="navbar-nav__link">
                <img style="width: 35px;" src="{{ asset('images/default.jpg') }}" alt="{{ Auth::user()->name }}">
                {{ Auth::user()->name }}
            </button>
        </li>
        <li>
            <logout text={{ trans('menu.logout') }}></logout>
        </li>
    @endif
</ul>