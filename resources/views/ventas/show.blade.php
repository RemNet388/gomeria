@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Detalle de Venta #{{ $venta->id }}</h2>

    <div class="mb-3">
        <strong>Cliente:</strong> {{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }} <br>
        <strong>Forma de Pago:</strong> {{ $venta->formaPago->nombre }} <br>
        <strong>Fecha:</strong> {{ $venta->fecha }} <br>
        <strong>Total:</strong> $ {{ number_format($venta->total, 2, ',', '.') }}
    </div>

    <h5>Ítems vendidos:</h5>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
                <tr>
                    <td>
                        @if($detalle->producto_id)
                            Producto
                        @elseif($detalle->servicio_id)
                            Servicio
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($detalle->producto_id)
                            {{ $detalle->producto->nombre }}
                        @elseif($detalle->servicio_id)
                            {{ $detalle->servicio->nombre }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>$ {{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                    <td>$ {{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3 btn-custom">⬅️ Volver al listado</a>
</div>
@endsection
