<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
{
    $ventas = \App\Models\Venta::latest()->get();
    return view('ventas.index', compact('ventas'));
}


public function create()
{
    $productos = Producto::select('id', 'nombre', 'precio_venta')->get();
    return view('ventas.create', compact('productos'));
}

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $venta = Venta::create([
                'fecha' => now(),
                'tipo' => $request->tipo,
                'total' => 0, // se actualiza luego
            ]);

            $total = 0;

            if ($request->tipo === 'producto') {
                foreach ($request->productos as $item) {
                    if ($item['producto_id']) {
                        $producto = Producto::find($item['producto_id']);
                        $subtotal = $producto->precio * $item['cantidad'];

                        DetalleVenta::create([
                            'venta_id' => $venta->id,
                            'producto_id' => $producto->id,
                            'cantidad' => $item['cantidad'],
                            'precio_unitario' => $producto->precio,
                            'subtotal' => $subtotal,
                        ]);

                        $total += $subtotal;
                        $producto->stock -= $item['cantidad'];
                        $producto->save();
                    }
                }
            } else {
                // servicios
                foreach ($request->servicios as $item) {
                    $subtotal = $item['precio'] * $item['cantidad'];

                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'servicio' => $item['nombre'],
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio'],
                        'subtotal' => $subtotal,
                    ]);

                    $total += $subtotal;
                }
            }

            $venta->total = $total;
            $venta->save();

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }
}
