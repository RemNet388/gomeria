@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar nueva venta</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay errores en el formulario:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de venta</label>
            <select name="tipo" class="form-select" required>
                <option value="producto">Producto</option>
                <option value="servicio">Servicio</option>
            </select>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered" id="tabla-items">
                <thead>
                    <tr>
                        <th>Producto / Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="items">
                    <!-- Filas dinámicas -->
                </tbody>
            </table>
            <button type="button" class="btn btn-sm btn-secondary" onclick="agregarFila()">+ Agregar ítem</button>
        </div>

        <div class="mb-3 text-end">
            <label class="form-label"><strong>Total: $</strong></label>
            <span id="total">0.00</span>
        </div>

        <button type="submit" class="btn btn-primary">Registrar venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let productos = @json($productos); // Lista pasada desde el backend

    function agregarFila() {
        const fila = document.createElement('tr');
        const index = document.querySelectorAll('#items tr').length;

        fila.innerHTML = `
            <td>
                <select name="items[${index}][producto_id]" class="form-select" onchange="actualizarPrecio(this, ${index})">
                    <option value="">-- Servicio (descripción libre) --</option>
                    ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio_venta}">${p.nombre}</option>`).join('')}
                </select>
                <input type="text" name="items[${index}][descripcion]" class="form-control mt-1" placeholder="Descripción (si es servicio)">
            </td>
            <td><input type="number" name="items[${index}][cantidad]" class="form-control" value="1" min="1" oninput="recalcular(${index})"></td>
            <td><input type="number" step="0.01" name="items[${index}][precio_unitario]" class="form-control" oninput="recalcular(${index})"></td>
            <td><input type="text" class="form-control-plaintext" name="items[${index}][subtotal]" readonly value="0.00"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarFila(this)">X</button></td>
        `;

        document.getElementById('items').appendChild(fila);
    }

    function actualizarPrecio(select, index) {
        const selected = select.options[select.selectedIndex];
        const precio = selected.getAttribute('data-precio') || 0;
        document.querySelectorAll(`input[name="items[${index}][precio_unitario]"]`)[0].value = precio;
        recalcular(index);
    }

    function recalcular(index) {
        const cantidad = document.querySelectorAll(`input[name="items[${index}][cantidad]"]`)[0].value || 0;
        const precio = document.querySelectorAll(`input[name="items[${index}][precio_unitario]"]`)[0].value || 0;
        const subtotal = parseFloat(cantidad) * parseFloat(precio);
        document.querySelectorAll(`input[name="items[${index}][subtotal]"]`)[0].value = subtotal.toFixed(2);

        // actualizar total general
        let total = 0;
        document.querySelectorAll('input[name$="[subtotal]"]').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total').innerText = total.toFixed(2);
    }

    function eliminarFila(btn) {
        btn.closest('tr').remove();
        // actualizar total
        let total = 0;
        document.querySelectorAll('input[name$="[subtotal]"]').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total').innerText = total.toFixed(2);
    }

    // Agregar al menos una fila al cargar
    window.onload = () => agregarFila();
</script>
@endsection
