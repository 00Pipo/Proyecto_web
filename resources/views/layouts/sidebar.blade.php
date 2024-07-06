<aside class="sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Prueba Bruno</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link text-white {{ Route::is('home') ? 'active' : '' }}">
                <i class="bi bi-house-fill"></i>
                Home
            </a>
        </li>
        @if (Auth::user()->isAdmin())
            <hr class="divider">
            <span class="text-white">| Administracion</span>
            <li>
                <a href="{{ route('admin.users') }}"
                    class="nav-link text-white {{ Route::is('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    Usuarios
                </a>
            </li>
            <li>
                <a href="{{ route('tiposVehiculos.index') }}"
                    class="nav-link text-white {{ Route::is('tiposVehiculos.index') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    Tipos Vehiculos
                </a>
            </li>
        @endif

        <hr class="divider">
        <span class="text-white">| Gestion</span>
        <li>
            <a href="{{ route('vehiculos.index') }}"
                class="nav-link text-white {{ Route::is('vehiculos.index') ? 'active' : '' }}">
                <i class="bi bi-car-front"></i>
                Vehiculos
            </a>
        </li>

        <li>
            <a href="{{ route('clientes.index') }}"
                class="nav-link text-white {{ Route::is('clientes.index') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Clientes
            </a>
        </li>

        <li>
            <a href="{{ route('arriendos.index') }}"
                class="nav-link text-white {{ Route::is('arriendos.index') ? 'active' : '' }}">
                <i class="bi bi-calendar2-check"></i>
                Arriendos
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ Auth::user()->name }} ({{ Auth::user()->perfil->nombre }})</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                    class="dropdown-item" href="#">Cerrar Sesión</a></li>
        </ul>
    </div>
</aside>
