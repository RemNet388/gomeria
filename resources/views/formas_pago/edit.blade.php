@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Editar Forma de Pago</h2>

    <form action="{{ route('formas-pago.update', $forma) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $forma->nombre }}" required>
        </div>
        <button class="btn btn-primary btn-custom">Actualizar</button>
    </form>
</div>
@endsection
