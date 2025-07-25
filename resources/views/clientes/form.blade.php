@csrf

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="marca" class="form-label">Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ old('marca', $cliente->marca ?? '') }}">
</div>

<div class="mb-3">
    <label for="medida" class="form-label">Medida</label>
    <input type="text" name="medida" class="form-control" value="{{ old('medida', $producto->medida ?? '') }}">
</div>

<div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad', $producto->cantidad ?? 0) }}" required>
</div>

<div class="mb-3">
    <label for="precio_venta" class="form-label">Precio de Venta</label>
    <input type="number" step="0.01" name="precio_venta" class="form-control" value="{{ old('precio_venta', $producto->precio_venta ?? '') }}">
</div>

<div class="mb-3">
    <label for="precio_compra" class="form-label">Precio de Compra</label>
    <input type="number" step="0.01" name="precio_compra" class="form-control" value="{{ old('precio_compra', $producto->precio_compra ?? '') }}">
</div>
