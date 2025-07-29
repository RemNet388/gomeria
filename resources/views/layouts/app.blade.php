<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Integral</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">🏁 Menú de Navegación</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.index') }}">📦 Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clientes.index') }}">👤 Clientes2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vehiculos.index') }}">🚗 Vehículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ordenes-trabajo.index') }}">🛠️ Órdenes</a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="{{ route('ventas.index') }}">💰 Ventas</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-light">{{ Auth::user()->name ?? 'Invitado' }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

        @yield('content')
        @yield('scripts')
    </div>
</body>
</html>
