@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">✏️ Editar Servicio</h2>

    <form action="{{ route('servicios.update', $servicio) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $servicio->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $servicio->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="{{ $servicio->precio }}" required>
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Actualizar</button>
    </form>
</div>
@endsection