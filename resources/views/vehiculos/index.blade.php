@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vehículos</h1>

    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Agregar vehículo</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Patente</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->cliente->nombre }}</td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->patente }}</td>
                <td>{{ $vehiculo->anio }}</td>
                <td>
                    <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este vehículo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
