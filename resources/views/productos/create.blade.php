@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Agregar nuevo producto</h2>

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

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
        </div>

        <div class="mb-3">
            <label for="medida" class="form-label">Medida</label>
            <input type="text" name="medida" class="form-control" value="{{ old('medida') }}">
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad *</label>
            <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', 0) }}" required>
        </div>

        <div class="mb-3">
            <label for="precio_compra" class="form-label">Precio de compra</label>
            <input type="number" step="0.01" name="precio_compra" class="form-control" value="{{ old('precio_compra') }}">
        </div>

        <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio de venta</label>
            <input type="number" step="0.01" name="precio_venta" class="form-control" value="{{ old('precio_venta') }}">
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría *</label>
            <select name="categoria" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Guardar producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
