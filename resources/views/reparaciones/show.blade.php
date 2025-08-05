@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="section-title">Reparación #{{ $reparacion->id }}</h3>

    <div class="mb-3">
        <strong>Cliente:</strong> {{ $reparacion->cliente->nombre }} {{ $reparacion->cliente->apellido }} <br>
        <strong>Vehículo:</strong> {{ $reparacion->vehiculo->marca }} {{ $reparacion->vehiculo->modelo }} <br>
        <strong>Estado:</strong> {{ $reparacion->estado }} <br>
        <strong>Fecha de ingreso:</strong> {{ $reparacion->fecha_ingreso }} <br>
        <strong>Total:</strong> ${{ number_format($reparacion->total, 2) }}
    </div>

    <h5>Detalle</h5>
    <p>{{ $reparacion->detalle }}</p>

    @if($reparacion->observaciones)
        <h5>Observaciones</h5>
        <p>{{ $reparacion->observaciones }}</p>
    @endif

    <h5>Ítems cargados</h5>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Detalle</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reparacion->items as $item)
                <tr>
                    <td>{{ ucfirst($item->tipo) }}</td>
                    <td>
    @if($item->tipo === 'producto')
        {{ optional($item->producto)->nombre ?? 'Producto eliminado' }}
    @else
        {{ optional($item->servicio)->nombre ?? $item->nombre ?? 'Servicio eliminado' }}
    @endif
</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('reparaciones.index') }}" class="btn btn-secondary  btn-custom">← Volver</a>
    @if($reparacion->estado !== 'Finalizado')
        <a href="{{ route('reparaciones.generarVenta', $reparacion) }}" class="btn btn-success float-end  btn-custom">💳 Generar Venta</a>
    
    
<hr>
<h5  class="section-title">Agregar producto o servicio</h5>

<form action="{{ route('reparaciones.addItem', $reparacion) }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-2">
        <label>Tipo</label>
        <select name="tipo" class="form-select" required onchange="toggleTipo(this.value)">
            <option value="producto">Producto</option>
            <option value="servicio">Servicio</option>
        </select>
    </div>

    <div class="col-md-3" id="productoSelect">
        <label>Producto</label>
        <select name="producto_id" class="form-select" onchange="setPrecio(this)">
            <option value="">Seleccione</option>
    @foreach(\App\Models\Producto::all() as $p)
        <option value="{{ $p->id }}" data-precio="{{ $p->precio_venta }}">{{ $p->nombre }}</option>
    @endforeach
</select>
    </div>

    <div class="col-md-3 d-none" id="servicioSelect">
        <label>Servicio</label>
        <select name="servicio_id" class="form-select" onchange="setPrecio(this)">
            <option value="">Seleccione</option>
    @foreach(\App\Models\Servicio::all() as $p)
        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">{{ $p->nombre }}</option>
    @endforeach
</select>
    </div>

    <div class="col-md-2">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" value="1" required>
    </div>

    <div class="col-md-2">
        <label>Precio</label>
        <input type="number" name="precio_unitario" class="form-control" step="0.01" required>
    </div>
    <div class="col-12">
        <button class="btn btn-success">➕ Agregar Ítem</button>
    </div>
</form>

<script>
function toggleTipo(tipo) {
    document.getElementById('productoSelect').classList.toggle('d-none', tipo !== 'producto');
    document.getElementById('servicioSelect').classList.toggle('d-none', tipo !== 'servicio');
    document.querySelector('input[name="precio_unitario"]').value = '';
}

function setPrecio(select) {
    const selected = select.options[select.selectedIndex];
    const precio = selected.getAttribute('data-precio') || 0;
    document.querySelector('input[name="precio_unitario"]').value = precio;
}
</script>
</div>@endif
@endsection
