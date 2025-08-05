<?php

namespace App\Http\Controllers;

use App\Models\Reparacion;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\FormaPago;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ReparacionController extends Controller
{
    public function index()
    {
        $reparaciones = Reparacion::with('cliente', 'vehiculo')->latest()->get();
        return view('reparaciones.index', compact('reparaciones'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('reparaciones.create', compact('clientes', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'observaciones' => 'nullable|string',
            'detalle' => 'required|string',
            'fecha_ingreso' => 'required|date',
        ]);

        Reparacion::create($request->all());

        return redirect()->route('reparaciones.index')->with('success', 'Reparación creada correctamente.');
    }

    public function show(Reparacion $reparacion)
    {
        $reparacion->load('cliente', 'vehiculo', 'items.producto', 'items.servicio');
        return view('reparaciones.show', compact('reparacion'));
    }

    public function edit(Reparacion $reparacion)
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('reparaciones.edit', compact('reparacion', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, Reparacion $reparacion)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'observaciones' => 'nullable|string',
            'detalle' => 'required|string',
            'fecha_ingreso' => 'required|date',
        ]);

        $reparacion->update($request->all());

        return redirect()->route('reparaciones.index')->with('success', 'Reparación actualizada.');
    }
    
    public function generarVenta(Reparacion $reparacion)
{
    $formasPago = FormaPago::all();
    return view('reparaciones.generar_venta', compact('reparacion', 'formasPago'));
}

    public function destroy(Reparacion $reparacion)
    {
        $reparacion->delete();
        return redirect()->route('reparaciones.index')->with('success', 'Reparación eliminada.');
    }

    public function confirmarVenta(Reparacion $reparacion, Request $request)
{
    $request->validate([
        'forma_pago_id' => 'required|exists:forma_pagos,id',
    ]);

    DB::beginTransaction();

    try {
        $venta = Venta::create([
            'cliente_id' => $reparacion->cliente_id,
            'forma_pago_id' => $request->forma_pago_id,
            'total' => 0,
            'fecha' => now(),
        ]);

        $total = 0;

        foreach ($reparacion->items as $item) {
            $subtotal = $item->subtotal;

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $item->tipo === 'producto' ? $item->producto_id : null,
                'servicio' => $item->tipo === 'servicio' ? $item->servicio->nombre : null,
                'cantidad' => $item->cantidad,
                'precio_unitario' => $item->precio_unitario,
                'subtotal' => $subtotal,
            ]);

            if ($item->tipo === 'producto' && $item->producto) {
                $item->producto->cantidad -= $item->cantidad;
                $item->producto->save();
            }

            $total += $subtotal;
        }

        $venta->total = $total;
        $venta->save();
        $reparacion->estado = 'Finalizado';
        $reparacion->save();


        DB::commit();

        return redirect()->route('ventas.index')->with('success', 'Venta generada correctamente desde reparación.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al generar la venta: ' . $e->getMessage());
    }
}

    public function addItem(Request $request, Reparacion $reparacion)
{
    $request->validate([
        'tipo' => 'required|in:producto,servicio',
        'producto_id' => 'nullable|exists:productos,id',
        'servicio_id' => 'nullable|exists:servicios,id',
        'cantidad' => 'required|numeric|min:1',
        'precio_unitario' => 'required|numeric|min:0',
    ]);

    $item = new \App\Models\ReparacionItem([
        'tipo' => $request->tipo,
        'producto_id' => $request->tipo === 'producto' ? $request->producto_id : null,
        'servicio_id' => $request->tipo === 'servicio' ? $request->servicio_id : null,
        'cantidad' => $request->cantidad,
        'precio_unitario' => $request->precio_unitario,
        'subtotal' => $request->cantidad * $request->precio_unitario,
    ]);

    $reparacion->items()->save($item);

    // Actualiza el total de la reparación
    $reparacion->total = $reparacion->items->sum('subtotal');
    $reparacion->save();

    return redirect()->route('reparaciones.show', $reparacion)->with('success', 'Ítem agregado correctamente.');
}

}
