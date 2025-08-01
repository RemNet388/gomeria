@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Registrar Venta</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Cliente</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Seleccione</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Forma de pago</label>
                <select name="forma_pago_id" class="form-select" required>
                    <option value="">Seleccione</option>
                    @foreach($formasPago as $fp)
                        <option value="{{ $fp->id }}">{{ $fp->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Tipo</label>
                <select id="tipo" class="form-select">
                    <option value="producto" selected>Producto</option>
                    <option value="servicio">Servicio</option>
                </select>
            </div>
        </div>

        <hr>

        <div id="itemsContainer"></div>

        <button type="button" id="addItemBtn" class="btn btn-secondary mb-3 btn-custom">➕ Agregar ítem</button>

        <div class="mb-3">
            <label>Total (editable)</label>
            <input type="number" name="total" id="totalInput" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success btn-custom">Registrar venta</button>
    </form>
</div>

{{-- Esto expone los datos a JS --}}
<script>
    window.productos = @json($productos);
    window.servicios = @json($servicios);
</script>
@endsection
