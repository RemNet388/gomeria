@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Resumen de Caja - {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</h3>
    <p>Total del día: <strong>$ {{ number_format($total, 2, ',', '.') }}</strong></p>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Forma de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('H:i') }}</td>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>
                    <td>{{ $venta->formaPago->nombre }}</td>
                    <td>$ {{ number_format($venta->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form method="POST" action="{{ route('caja.generarPDF') }}" target="_blank">
        @csrf
        <input type="hidden" name="fecha" value="{{ $fecha }}">
        <button type="submit" class="btn btn-primary btn-custom">✉️ Descargar resumen PDF</button>
    </form>
</div>
@endsection