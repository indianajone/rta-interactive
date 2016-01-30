<ul class="nav navbar-nav">
    @if(!Auth::check())
        <li>
            <a @click="openModal('login', 'login')" class="navbar-nav__link">{{ trans('menu.login') }}</a>
        </li>
        <li>
            <a @click="openModal('login', 'register')" class="navbar-nav__link">{{trans('menu.register') }}</a>
        </li>
        <li>
            <a  @click="openModal('login', 'forget')" class="navbar-nav__link">{{trans('menu.forget_password') }}</a>
        </li>
    @else 
        <li>
            <a href="{{ route('profile_path', ['lang' => session()->get('locale')]) }}" class="navbar-nav__link">
                <img class="img-circle" style="width: 30px;" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                {{ Auth::user()->name }}
            </a>
        </li>
        <li>
            <logout text={{ trans('menu.logout') }}></logout>
        </li>
    @endif
</ul>