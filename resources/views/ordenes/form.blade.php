@csrf

<div class="mb-3">
    <label for="vehiculo_id" class="form-label">Vehículo</label>
    <select name="vehiculo_id" class="form-control" required>
        <option value="">Seleccione un vehículo</option>
        @foreach ($vehiculos as $vehiculo)
            <option value="{{ $vehiculo->id }}"
                {{ old('vehiculo_id', $orden->vehiculo_id ?? '') == $vehiculo->id ? 'selected' : '' }}>
                {{ $vehiculo->cliente->nombre }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->patente }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="detalle" class="form-label">Detalle</label>
    <textarea name="detalle" class="form-control">{{ old('detalle', $orden->detalle ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-control">
        @foreach (['Pendiente', 'En reparación', 'Finalizado'] as $estado)
            <option value="{{ $estado }}" {{ old('estado', $orden->estado ?? '') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="fecha_entrada" class="form-label">Fecha de entrada</label>
    <input type="date" name="fecha_entrada" class="form-control" value="{{ old('fecha_entrada', $orden->fecha_entrada ?? '') }}">
</div>

<div class="mb-3">
    <label for="fecha_salida" class="form-label">Fecha de salida</label>
    <input type="date" name="fecha_salida" class="form-control" value="{{ old('fecha_salida', $orden->fecha_salida ?? '') }}">
</div>
