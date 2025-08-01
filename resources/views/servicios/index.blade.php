@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">🛠️ Servicios</h2>
    <a href="{{ route('servicios.create') }}" class="btn btn-success mb-3 btn-custom">➕ Nuevo Servicio</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ $servicio->nombre }}</td>
                    <td>{{ $servicio->descripcion }}</td>
                    <td>${{ number_format($servicio->precio, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-custom" onclick="return confirm('¿Eliminar este servicio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
