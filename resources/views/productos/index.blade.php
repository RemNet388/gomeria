@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos</h1>

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar producto</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Medida</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->medida }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>${{ number_format($producto->precio_venta, 2) }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
