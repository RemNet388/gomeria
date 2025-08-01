<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'formaPago')->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = \App\Models\Cliente::all();
        $formasPago = \App\Models\FormaPago::all();
        $productos = Producto::select('id', 'nombre', 'precio_venta')->get();
        $servicios = Servicio::select('id', 'nombre', 'precio')->get();

        return view('ventas.create', compact('clientes', 'formasPago', 'productos', 'servicios'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'forma_pago_id' => $request->forma_pago_id,
                'fecha' => now(),
                'total' => $request->total ?? 0,
            ]);

            foreach ($request->items as $item) {
                $cantidad = $item['cantidad'];
                $precio = $item['precio'];
                $subtotal = $cantidad * $precio;

                $detalle = new DetalleVenta([
                    'venta_id' => $venta->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal,
                ]);

                if ($item['tipo'] === 'producto') {
                    $detalle->producto_id = $item['producto_id'];

                    // Descontar stock
                    $producto = Producto::find($item['producto_id']);
                    if ($producto) {
                        $producto->cantidad -= $cantidad;
                        $producto->save();
                    }
                } elseif ($item['tipo'] === 'servicio') {
                    $detalle->servicio_id = $item['servicio_id'];
                }

                $detalle->save();
            }

            DB::commit();
            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function show(Venta $venta)
    {
        $venta->load('cliente', 'formaPago', 'detalles.producto', 'detalles.servicio');
        return view('ventas.show', compact('venta'));
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada');
    }
}
