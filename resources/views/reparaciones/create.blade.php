@extends('layouts.app')

@section('content')
<div class="container">
    <h3  class="section-title">Nueva Reparación</h3>

    <form action="{{ route('reparaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Vehículo</label>
            <select name="vehiculo_id" class="form-select" required>
                @foreach($vehiculos as $v)
                    <option value="{{ $v->id }}">{{ $v->marca }} {{ $v->modelo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                <option>Pendiente</option>
                <option>En proceso</option>
                <option>Finalizado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Detalle</label>
            <textarea name="detalle" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="2"></textarea>
        </div>

        <button class="btn btn-success  btn-custom">💾 Guardar Reparación</button>
    </form>
</div>
@endsection
