@extends('layouts.app')

@section('content')
<div class="container">
    <h2>💰 Ventas</h2>

    <a href="{{ route('ventas.create') }}" class="btn btn-success mb-3">➕ Nueva Venta</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ ucfirst($venta->tipo) }}</td>
                    <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('ventas.show', $venta) }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta venta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
