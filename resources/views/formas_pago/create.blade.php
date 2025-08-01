@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Nueva Forma de Pago</h2>

    <form action="{{ route('formas-pago.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <button class="btn btn-success btn-custom">Guardar</button>
    </form>
</div>
@endsection
