<header class="main-header px-1 py-2">
    <div class="logo text-center mb-2 mb-md-0">
        <a class="nav-link" href="{{url('/') }}">
            <img  class="logo-img" style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="Logo">
        </a>
    </div>

    <nav class="nav d-flex flex-column flex-md-row px-3 mt-4 justify-content-center align-items-center">
        <div class="d-flex flex-column flex-md-row gap-2 gap-md-5 mb-3 mb-md-0">
            @auth
            <a class="dropdown-item" href="{{ url('/') }}">{{__('Home')}}</a>
            <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
            <a class="dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a>
            <a class="dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a>
            <a class="dropdown-item" href="{{ url('admin/orders') }}">{{__('I tuoi ordini')}}</a>
            @endif
        </div>

         <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto flex-column flex-md-row gap-3">
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