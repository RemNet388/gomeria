import './bootstrap';
import 'bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 0;

    function renderItem() {
        const container = document.getElementById('itemsContainer');
        const tipoDefault = 'producto';

        let html = `<div class="row align-items-end mb-2 item-row border-bottom pb-2" data-index="${itemIndex}">`;

        // Selector de tipo por ítem
        html += `
            <div class="col-md-2">
                <label>Tipo</label>
                <select class="form-select tipo-select" name="items[${itemIndex}][tipo]">
                    <option value="producto" selected>Producto</option>
                    <option value="servicio">Servicio</option>
                </select>
            </div>
        `;

        // Contenedor dinámico
        html += `
            <div class="col-md-10 tipo-contenido">
                ${renderTipoContenido(tipoDefault, itemIndex)}
            </div>
        `;

        html += `</div>`;

        container.insertAdjacentHTML('beforeend', html);
        itemIndex++;
        recalcularTotales();
    }

    function renderTipoContenido(tipo, index) {
        let contenido = `
            <div class="row">
                <div class="col-md-4">
                    <label>${tipo === 'producto' ? 'Producto' : 'Servicio'}</label>
                    <select name="items[${index}][${tipo}_id]" class="form-select ${tipo}-select">
                        <option value="">Seleccione</option>
                        ${tipo === 'producto'
                            ? window.productos.map(p => `<option value="${p.id}" data-precio="${p.precio_venta}">${p.nombre}</option>`).join('')
                            : window.servicios.map(s => `<option value="${s.id}" data-precio="${s.precio}">${s.nombre}</option>`).join('')
                        }
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Cantidad</label>
                    <input type="number" name="items[${index}][cantidad]" class="form-control cantidad" value="1" min="1">
                </div>

                <div class="col-md-2">
                    <label>Precio</label>
                    <input type="number" name="items[${index}][precio]" class="form-control precio" step="0.01">
                </div>

                <div class="col-md-2">
                    <label>Subtotal</label>
                    <input type="text" class="form-control subtotal" readonly>
                </div>

                <div class="col-md-2 mt-2">
                    <button type="button" class="btn btn-danger w-100 btn-remove">🗑️</button>
                </div>
            </div>
        `;
        return contenido;
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
        renderItem();

        document.getElementById('addItemBtn').addEventListener('click', function () {
            renderItem();
        });

        // Cambio de tipo en un ítem individual
        document.getElementById('itemsContainer').addEventListener('change', function (e) {
            if (e.target.matches('.tipo-select')) {
                const row = e.target.closest('.item-row');
                const index = row.getAttribute('data-index');
                const tipo = e.target.value;
                const contenido = renderTipoContenido(tipo, index);
                row.querySelector('.tipo-contenido').innerHTML = contenido;
            }

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
