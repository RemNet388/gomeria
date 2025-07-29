@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Órdenes de Trabajo</h2>

    <a href="{{ route('ordenes-trabajo.create') }}" class="btn btn-success mb-3">Nueva Orden</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $orden)
                <tr>
                    <td>{{ $orden->id }}</td>
                    <td>{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</td>
                    <td>{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</td>
                    <td>{{ $orden->fecha_ingreso }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>${{ number_format($orden->total, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('ordenes-trabajo.edit', $orden) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('ordenes-trabajo.destroy', $orden) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar esta orden?')" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($ordenes->isEmpty())
                <tr><td colspan="7" class="text-center">No hay órdenes registradas aún.</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
