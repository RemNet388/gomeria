@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Movimientos del día</h2>

    <form method="GET" action="{{ route('caja.index') }}" class="row g-3 mb-3">
        <div class="col-auto">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $fecha }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary btn-custom">Filtrar</button>
            <a href="{{ route('caja.cerrar', ['fecha' => $fecha]) }}" class="btn btn-success btn-custom">
                ⚖️ Cerrar caja (PDF)
            </a>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Forma de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->fecha->format('H:i') }}</td>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>
                    <td>{{ $venta->formaPago->nombre }}</td>
                    <td>$ {{ number_format($venta->total, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No hay movimientos.</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total del día</th>
                <th>$ {{ number_format($total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
