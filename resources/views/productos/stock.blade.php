@extends('layouts.app')

@section('content')
<h2 class="section-title">📦 Stock actual de productos</h2>

<a href="{{ route('productos.descargarStock') }}" class="btn btn-sm btn-outline-secondary mb-3">📄 Descargar PDF</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->cantidad }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
