<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-2">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            Nombre Empresa
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">📦 Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">👤 Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('vehiculos.index') }}">🚗 Vehículos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('servicios.index') }}">🔧 Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ventas.index') }}">💰 Ventas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ordenes-trabajo.index') }}">🛠️ Órdenes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('caja.index') }}">📊 Caja</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('formas-pago.index') }}">💳 Formas de pago</a></li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item me-3 mt-1 text-end">
                    <span class="nav-link text-dark">{{ Auth::user()->name ?? 'Invitado' }}</span>
                    <small class="text-muted ms-3 d-block">Gomería</small>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger mt-2">Salir</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
