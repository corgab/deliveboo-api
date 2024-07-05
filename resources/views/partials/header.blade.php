<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">
            <img class="logo-img" style="width: 110px" src="{{ asset('storage/images/logo.png') }}" alt="Logo">
        </a>

        {{-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> --}}

        <div class="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarToggler">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{__('Home')}}</a></li>
                <li class="nav-item"><a class="nav-link dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a></li>
                <li class="nav-item"><a class="nav-link dropdown-item" href="{{ url('admin/dishes') }}">{{__('Il tuo menu')}}</a></li>
                <li class="nav-item"><a class="nav-link dropdown-item" href="{{ url('admin/dishes/create') }}">{{__('Aggiungi un piatto')}}</a></li>
                <li class="nav-item"><a class="nav-link dropdown-item" href="{{ url('admin/orders') }}">{{__('I tuoi ordini')}}</a></li>
                <li class="nav-item"><a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    </div>
    
</nav>
