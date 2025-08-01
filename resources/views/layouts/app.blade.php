<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Integral</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-2">
        </div>
        @yield('content')
        @yield('scripts')
    </div>
</body>
</html>
