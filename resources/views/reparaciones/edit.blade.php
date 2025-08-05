@extends('layouts.app')

@section('content')
<div class="container">
    <h3  class="section-title">Editar Reparación #{{ $reparacion->id }}</h3>

    <form action="{{ route('reparaciones.update', ['reparacion' => $reparacion->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}" {{ $reparacion->cliente_id == $c->id ? 'selected' : '' }}>
                        {{ $c->nombre }} {{ $c->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Vehículo</label>
            <select name="vehiculo_id" class="form-select" required>
                @foreach($vehiculos as $v)
                    <option value="{{ $v->id }}" {{ $reparacion->vehiculo_id == $v->id ? 'selected' : '' }}>
                        {{ $v->marca }} {{ $v->modelo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="{{ $reparacion->fecha_ingreso }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                @foreach(['Pendiente', 'En proceso', 'Finalizado'] as $estado)
                    <option value="{{ $estado }}" {{ $reparacion->estado == $estado ? 'selected' : '' }}>
                        {{ $estado }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Detalle</label>
            <textarea name="detalle" class="form-control" rows="3">{{ $reparacion->detalle }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="2">{{ $reparacion->observaciones }}</textarea>
        </div>

        <button class="btn btn-primary  btn-custom">💾 Actualizar Reparación</button>
    </form>
</div>
@endsection
