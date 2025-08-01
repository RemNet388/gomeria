import './bootstrap';
import 'bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 0;

    function renderItem() {
        const tipo = document.getElementById('tipo').value;
        const container = document.getElementById('itemsContainer');
        let html = `<div class="row align-items-end mb-2 item-row border-bottom pb-2">`;

        // Tipo visual
        html += `
            <input type="hidden" name="items[${itemIndex}][tipo]" value="${tipo}">
            <div class="col-md-12"><strong>${tipo === 'producto' ? '🟦 Producto' : '🟩 Servicio'}</strong></div>
        `;

        if (tipo === 'producto') {
            html += `
                <div class="col-md-4">
                    <label>Producto</label>
                    <select name="items[${itemIndex}][producto_id]" class="form-select producto-select">
                        <option value="">Seleccione</option>
                        ${window.productos.map(p => `<option value="${p.id}" data-precio="${p.precio_venta}">${p.nombre}</option>`).join('')}
                    </select>
                </div>
            `;
        } else {
            html += `
                <div class="col-md-4">
                    <label>Servicio</label>
                    <select name="items[${itemIndex}][servicio_id]" class="form-select servicio-select">
                        <option value="">Seleccione</option>
                        ${window.servicios.map(s => `<option value="${s.id}" data-precio="${s.precio}">${s.nombre}</option>`).join('')}
                    </select>
                </div>
            `;
        }

        html += `
            <div class="col-md-2">
                <label>Cantidad</label>
                <input type="number" name="items[${itemIndex}][cantidad]" class="form-control cantidad" value="1" min="1">
            </div>
            <div class="col-md-2">
                <label>Precio</label>
                <input type="number" name="items[${itemIndex}][precio]" class="form-control precio" step="0.01">
            </div>
            <div class="col-md-2">
                <label>Subtotal</label>
                <input type="text" class="form-control subtotal" readonly>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 btn-remove">🗑️</button>
            </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', html);
        itemIndex++;
        recalcularTotales();
    }

    function recalcularTotales() {
        let total = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const cantidad = parseFloat(row.querySelector('.cantidad')?.value || 0);
            const precio = parseFloat(row.querySelector('.precio')?.value || 0);
            const subtotal = cantidad * precio;
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            total += subtotal;
        });

        const totalInput = document.getElementById('totalInput');
        if (document.activeElement !== totalInput) {
            totalInput.value = total.toFixed(2);
        }
    }

    if (document.getElementById('addItemBtn')) {
        // Agrega el primer ítem al iniciar
        renderItem();

        document.getElementById('addItemBtn').addEventListener('click', function () {
            renderItem();
        });

        // El cambio de tipo no borra ítems, simplemente afecta el siguiente ítem
        document.getElementById('tipo').addEventListener('change', function () {
            // No hacemos nada destructivo
        });

        document.getElementById('itemsContainer').addEventListener('change', function (e) {
            if (e.target.matches('.producto-select, .servicio-select')) {
                const selected = e.target.options[e.target.selectedIndex];
                const precio = selected.getAttribute('data-precio') || 0;
                const row = e.target.closest('.item-row');
                row.querySelector('.precio').value = precio;
                recalcularTotales();
            }
        });

        document.getElementById('itemsContainer').addEventListener('input', function (e) {
            if (e.target.matches('.cantidad, .precio')) {
                recalcularTotales();
            }
        });

        document.getElementById('itemsContainer').addEventListener('click', function (e) {
            if (e.target.matches('.btn-remove')) {
                e.target.closest('.item-row').remove();
                recalcularTotales();
            }
        });
    }
});
