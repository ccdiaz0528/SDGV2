<nav class="navbar navbar-expand-lg fade-in-down" style="background-color: #ffffff; animation-duration: 0.8s;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center zoom-in" href="{{ url('/home') }}" style="animation-delay: 0.2s;">
            <img src="{{ asset('assets/auto.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            <span class="ms-2" style="color: #000;">SDGV</span>
        </a>

        <button class="navbar-toggler fade-in" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            style="animation-delay: 0.3s;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse slide-in-left" id="navbarSupportedContent" style="animation-delay: 0.4s;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item fade-in" style="animation-delay: 0.5s;">
                    <a class="nav-link text-black hover-underline" href="{{ url('/home') }}">
                        <img src="{{ asset('assets/home.png') }}" alt="Inicio" width="15" height="15" class="me-2">
                        Inicio
                    </a>
                </li>

                @auth
                    @if(auth()->user()->hasVerifiedEmail())
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item fade-in" style="animation-delay: 0.6s;">
                                <a class="nav-link text-black hover-underline" href="{{ route('admin.users') }}">
                                    <img src="{{ asset('assets/user.png') }}" alt="Usuarios" width="15" height="15" class="me-2">
                                    Usuarios
                                </a>
                            </li>
                        @else
                            @foreach (['create','index'] as $i => $action)
                                <li class="nav-item fade-in" style="animation-delay: {{0.6 + ($i*0.1)}}s;">
                                    <a class="nav-link text-black hover-underline" href="{{ route('vehiculos.'.$action) }}">
                                        <img src="{{ asset('assets/'.($action=='create'?'registro_auto':'ojo').'.png') }}"
                                             alt="{{ $action=='create'?'Registrar Vehículo':'Ver Vehículos' }}"
                                             width="18" height="18" class="me-2">
                                        {{ $action=='create' ? 'Registrar Vehículo' : 'Ver mis Vehículos' }}
                                    </a>
                                </li>
                            @endforeach
                            @foreach (['create','index'] as $i => $action)
                                <li class="nav-item fade-in" style="animation-delay: {{0.8 + ($i*0.1)}}s;">
                                    <a class="nav-link text-black hover-underline" href="{{ route('licencias.'.$action) }}">
                                        <img src="{{ asset('assets/'.($action=='create'?'licencia':'ojo').'.png') }}"
                                             alt="{{ $action=='create'?'Registrar Licencia':'Ver Licencias' }}"
                                             width="22" height="22" class="me-2">
                                        {{ $action=='create' ? 'Registrar Licencia' : 'Ver Licencias' }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 slide-in-right" style="animation-delay: 1s;">
                @auth
                    <li class="nav-item dropdown fade-in" style="animation-delay: 1.1s;">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/user.png') }}" alt="User" width="30" height="30" class="rounded-circle me-2">
                            {{ auth()->user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item fade-in" style="animation-delay: 1.2s;">
                        <a class="btn btn-custom me-2 zoom-in" href="{{ url('/login') }}" style="animation-delay: 1.3s;">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item fade-in" style="animation-delay: 1.4s;">
                        <a class="btn btn-custom-register zoom-in" href="{{ url('/register') }}" style="animation-delay: 1.5s;">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
