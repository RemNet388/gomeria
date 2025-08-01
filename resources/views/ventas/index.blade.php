@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Listado de Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3 btn-custom">➕ Nueva Venta</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Forma de Pago</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>
                    <td>{{ $venta->formaPago->nombre }}</td>
                    <td>$ {{ number_format($venta->total, 2, ',', '.') }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>
                        <a href="{{ route('ventas.show', $venta) }}" class="btn btn-sm btn-info">👁️ Ver</a>

                        <form action="{{ route('ventas.destroy', $venta) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta venta?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger btn-custom">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
