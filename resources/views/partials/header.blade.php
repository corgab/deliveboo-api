<header class="main-header shadow-lg px-1">
    <div class="logo text-center">
        <a class="nav-link" href="{{url('/') }}">
            <img  class="logo-img" src="{{ Vite::asset('resources/img/logo.png')}}" alt="Logo">
        </a>
    </div>

    <nav class="nav d-flex px-2 justify-content-center align-items-center">
        <div class="d-flex gap-5">
            <a class="dropdown-item" href="{{ url('admin/restaurants/create') }}">{{__('Registra il tuo Ristorante')}}</a>
            <a class="dropdown-item" href="{{ url('admin/restaurants') }}">{{__('Il tuo Ristorante')}}</a>
            <a class="dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a>
            <a class="dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a>
        </div>

         <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
    </nav>

</header>