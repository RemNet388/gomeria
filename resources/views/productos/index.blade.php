@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Listado de productos</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3 btn-custom">Agregar nuevo producto</a>
    <a href="{{ route('productos.stock') }}" class="btn btn-outline-info btn-sm btn-custom">📋 Ver Stock</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Medida</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($productos as $producto)
            <tr>
                <td>
                    @if ($producto->foto)
                        <img src="{{ asset('storage/' . $producto->foto) }}" width="60" height="60" style="object-fit: cover;">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->medida }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>${{ number_format($producto->precio_compra, 2) }}</td>
                <td>${{ number_format($producto->precio_venta, 2) }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger btn-custom">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No hay productos cargados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
