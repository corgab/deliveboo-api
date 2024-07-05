<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img class="logo-img" style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="Logo">
        </a>

        {{-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> --}}

        <div class="d-block d-md-none">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
            <ul class="">
                <li><a class="nav-link" href="{{ url('/') }}">{{__('Home')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/orders') }}">{{__('I tuoi ordini')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Esci') }}</a></li>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endif
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
        @auth
            <ul class="d-none d-md-flex gap-3">
                <li><a class="nav-link" href="{{ url('/') }}">{{__('Home')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ url('admin/orders') }}">{{__('I tuoi ordini')}}</a></li>
                <li><a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Esci') }}</a></li>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endif
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
    </div>
    
</nav>
