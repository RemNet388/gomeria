@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📦 Stock de Productos</h2>

    <a href="{{ route('productos.descargarStock') }}" class="btn btn-sm btn-outline-primary mb-3">
        🖨️ Imprimir stock en PDF
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Medida</th>
                <th>Cantidad</th>
                <th>Precio Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>
                        @if($producto->foto)
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto" width="50">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->medida }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>${{ number_format($producto->precio_venta, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

