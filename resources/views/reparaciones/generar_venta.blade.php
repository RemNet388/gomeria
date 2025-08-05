@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Generar Venta para Reparación #{{ $reparacion->id }}</h3>

    <form method="POST" action="{{ route('reparaciones.confirmarVenta', $reparacion) }}">
        @csrf

        <div class="mb-3">
            <label>Forma de Pago</label>
            <select name="forma_pago_id" class="form-select" required>
                <option value="">Seleccione</option>
                @foreach($formasPago as $fp)
                    <option value="{{ $fp->id }}">{{ $fp->nombre }}</option>
                @endforeach
            </select>
        </div>

        <h5>Resumen de Ítems</h5>
        <ul class="list-group mb-3">
            @foreach($reparacion->items as $item)
                <li class="list-group-item">
                    {{ $item->tipo === 'producto' ? $item->producto->nombre : $item->servicio->nombre }}
                    × {{ $item->cantidad }} — ${{ number_format($item->subtotal, 2) }}
                </li>
            @endforeach
        </ul>

        <div class="mb-3">
            <strong>Total: ${{ number_format($reparacion->items->sum('subtotal'), 2) }}</strong>
        </div>

        <button class="btn btn-primary">💾 Confirmar y Generar Venta</button>
    </form>
</div>
@endsection
