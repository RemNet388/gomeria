@csrf

<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" name="marca" id="marca" class="form-control" 
           value="{{ old('marca', $vehiculo->marca ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" name="modelo" id="modelo" class="form-control" 
           value="{{ old('modelo', $vehiculo->modelo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="logo" class="form-label">Logo (opcional)</label>
    <input type="file" name="logo" id="logo" class="form-control">
    @if(isset($vehiculo) && $vehiculo->logo)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $vehiculo->logo) }}" alt="Logo" height="60">
        </div>
    @endif
</div>
<button type="submit" class="btn btn-primary  btn-custom">
    {{ isset($vehiculo) ? 'Actualizar' : 'Guardar' }}
</button>