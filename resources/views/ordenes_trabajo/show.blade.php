{{-- resources/views/ordenes_trabajo/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Orden de Trabajo #{{ $orden_trabajo->id }}</h3>

    <p><strong>Cliente:</strong> {{ $orden_trabajo->cliente->nombre }} {{ $orden_trabajo->cliente->apellido }}</p>
    <p><strong>Vehículo:</strong> {{ $orden_trabajo->vehiculo->marca }} {{ $orden_trabajo->vehiculo->modelo }}</p>
    <p><strong>Fecha de ingreso:</strong> {{ $orden_trabajo->fecha_ingreso }}</p>
    <p><strong>Estado:</strong> {{ $orden_trabajo->estado }}</p>

    <hr>

    <h5>Items</h5>
    <ul>
        @foreach($orden_trabajo->items as $item)
            <li>
                @if($item->producto)
                    🟦 <strong>{{ $item->producto->nombre }}</strong> ({{ $item->cantidad }} × ${{ $item->precio_unitario }})
                @elseif($item->servicio)
                    🟩 <strong>{{ $item->servicio->nombre }}</strong> ({{ $item->cantidad }} × ${{ $item->precio_unitario }})
                @endif
            </li>
        @endforeach
    </ul>

    <hr>

    <h5>Agregar producto o servicio</h5>
    <form method="POST" action="{{ route('ordenes-trabajo.agregar-item', $orden_trabajo->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <label>Tipo</label>
                <select name="tipo" class="form-select" id="tipo">
                    <option value="producto">Producto</option>
                    <option value="servicio">Servicio</option>
                </select>
            </div>
            <div class="col-md-4" id="productoSelect">
                <label>Producto</label>
                <select name="producto_id" class="form-select">
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-none" id="servicioSelect">
                <label>Servicio</label>
                <select name="servicio_id" class="form-select">
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" value="1">
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-success">Agregar</button>
        </div>
    </form>

    <hr>

    <h5>Generar venta</h5>
    <form method="POST" action="{{ route('ordenes-trabajo.generar-venta', $orden_trabajo->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label>Forma de pago</label>
                <select name="forma_pago_id" class="form-select" required>
                    @foreach($formasPago as $forma)
                        <option value="{{ $forma->id }}">{{ $forma->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-primary">🧾 Generar Venta</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('tipo').addEventListener('change', function () {
    if (this.value === 'producto') {
        document.getElementById('productoSelect').classList.remove('d-none');
        document.getElementById('servicioSelect').classList.add('d-none');
    } else {
        document.getElementById('productoSelect').classList.add('d-none');
        document.getElementById('servicioSelect').classList.remove('d-none');
    }
});
</script>
@endsection
