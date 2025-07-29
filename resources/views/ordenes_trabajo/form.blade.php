@csrf

<div class="mb-3">
    <label for="cliente_id" class="form-label">Cliente</label>
    <select name="cliente_id" class="form-select" required>
        <option value="">Seleccionar...</option>
        @foreach ($clientes as $cliente)
            <option value="{{ $cliente->id }}"
                {{ old('cliente_id', $orden_trabajo->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                {{ $cliente->nombre }} {{ $cliente->apellido }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="vehiculo_id" class="form-label">Vehículo</label>
    <select name="vehiculo_id" class="form-select" required>
        <option value="">Seleccionar...</option>
        @foreach ($vehiculos as $vehiculo)
            <option value="{{ $vehiculo->id }}"
                {{ old('vehiculo_id', $orden_trabajo->vehiculo_id ?? '') == $vehiculo->id ? 'selected' : '' }}>
                {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
    <input type="date" name="fecha_ingreso" class="form-control"
        value="{{ old('fecha_ingreso', $orden_trabajo->fecha_ingreso ?? date('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-select">
        @foreach(['Pendiente', 'En proceso', 'Finalizado'] as $estado)
            <option value="{{ $estado }}"
                {{ old('estado', $orden_trabajo->estado ?? 'Pendiente') == $estado ? 'selected' : '' }}>
                {{ $estado }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $orden_trabajo->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="observaciones" class="form-label">Observaciones</label>
    <textarea name="observaciones" class="form-control">{{ old('observaciones', $orden_trabajo->observaciones ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="total" class="form-label">Total</label>
    <input type="number" step="0.01" name="total" class="form-control"
        value="{{ old('total', $orden_trabajo->total ?? '') }}">
</div>
