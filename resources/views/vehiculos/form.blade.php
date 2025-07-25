@csrf

<div class="mb-3">
    <label for="cliente_id" class="form-label">Cliente</label>
    <select name="cliente_id" class="form-control" required>
        <option value="">Seleccione un cliente</option>
        @foreach ($clientes as $cliente)
            <option value="{{ $cliente->id }}"
                {{ old('cliente_id', $vehiculo->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                {{ $cliente->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca ?? '') }}">
</div>

<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo ?? '') }}">
</div>

<div class="mb-3">
    <label for="patente" class="form-label">Patente</label>
    <input type="text" name="patente" class="form-control" value="{{ old('patente', $vehiculo->patente ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="anio" class="form-label">Año</label>
    <input type="text" name="anio" class="form-control" value="{{ old('anio', $vehiculo->anio ?? '') }}">
</div>
