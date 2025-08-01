@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Editar producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Hubo algunos errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" value="{{ old('marca', $producto->marca) }}">
        </div>

        <div class="mb-3">
            <label for="medida" class="form-label">Medida</label>
            <input type="text" name="medida" class="form-control" value="{{ old('medida', $producto->medida) }}">
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad *</label>
            <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $producto->cantidad) }}" required>
        </div>

        <div class="mb-3">
            <label for="precio_compra" class="form-label">Precio de compra</label>
            <input type="number" step="0.01" name="precio_compra" class="form-control" value="{{ old('precio_compra', $producto->precio_compra) }}">
        </div>

        <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio de venta</label>
            <input type="number" step="0.01" name="precio_venta" class="form-control" value="{{ old('precio_venta', $producto->precio_venta) }}">
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría *</label>
            <select name="categoria" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat }}" {{ old('categoria', $producto->categoria) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            @if ($producto->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto actual" width="150">
                </div>
            @endif
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Actualizar producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
