@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vehículos</h2>

    <a href="{{ route('vehiculos.create') }}" class="btn btn-success mb-3">Agregar Vehículo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Logo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>
                        @if($vehiculo->logo)
                            <img src="{{ asset('storage/' . $vehiculo->logo) }}" alt="Logo" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar vehículo?')" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
