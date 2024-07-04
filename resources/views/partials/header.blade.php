<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="{{url('/')}}">
            <img class="logo-img" style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Profilo Utente
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ url('/') }}">{{__('Home')}}</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/orders') }}">{{__('I tuoi ordini')}}</a></li>
                            <li><a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
