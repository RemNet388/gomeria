<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Caja</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #aaa; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        h2 { margin-bottom: 0; }
    </style>
</head>
<body>
    <h2>📊 Resumen de Caja - {{ now()->format('d/m/Y') }}</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Forma de Pago</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>
                    <td>{{ $venta->formaPago->nombre ?? '-' }}</td>
                    <td>${{ number_format($venta->total, 2, ',', '.') }}</td>
                    <td>{{ $venta->fecha->format('H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top: 20px;">Total del día: ${{ number_format($total, 2, ',', '.') }}</h4>
</body>
</html>
