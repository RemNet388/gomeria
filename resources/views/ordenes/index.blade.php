@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes de Trabajo</h1>

    <a href="{{ route('ordenes-trabajo.create') }}" class="btn btn-primary mb-3">Nueva orden</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Estado</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($ordenes as $orden)
            <tr>
                <td>{{ $orden->vehiculo->cliente->nombre }}</td>
                <td>{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }} ({{ $orden->vehiculo->patente }})</td>
                <td>{{ $orden->estado }}</td>
                <td>{{ $orden->fecha_entrada }}</td>
                <td>{{ $orden->fecha_salida }}</td>
                <td>
                    <a href="{{ route('ordenes-trabajo.edit', $orden) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('ordenes-trabajo.destroy', $orden) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta orden?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
