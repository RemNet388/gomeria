@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title"
>Editar Orden de Trabajo #{{ $ordenes_trabajo->id }}</h2>

    <form action="{{ route('ordenes-trabajo.update', $ordenes_trabajo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $ordenes_trabajo->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vehículo</label>
            <select name="vehiculo_id" class="form-select" required>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id }}" {{ $ordenes_trabajo->vehiculo_id == $vehiculo->id ? 'selected' : '' }}>
                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="{{ $ordenes_trabajo->fecha_ingreso }}" required>
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">
                @foreach(['Pendiente', 'En proceso', 'Finalizado'] as $estado)
                    <option value="{{ $estado }}" {{ $ordenes_trabajo->estado == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ $ordenes_trabajo->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3">{{ $ordenes_trabajo->observaciones }}</textarea>
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" step="0.01" class="form-control" value="{{ $ordenes_trabajo->total }}">
        </div>

        <button type="submit" class="btn btn-primary btn-custom">Actualizar orden</button>
    </form>
</div>
@endsection
