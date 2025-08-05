<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\FormaPago;


class OrdenTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::with('cliente', 'vehiculo')->get();
        return view('ordenes_trabajo.index', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('ordenes_trabajo.create', compact('clientes', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'vehiculo_id'    => 'required|exists:vehiculos,id',
            'fecha_ingreso'  => 'required|date',
            'estado'         => 'required|string',
            'descripcion'    => 'nullable|string',
            'observaciones'  => 'nullable|string',
            'total'          => 'nullable|numeric',
        ]);

        OrdenTrabajo::create($request->all());

        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden creada correctamente.');
    }

    public function edit(OrdenTrabajo $orden_trabajo)
{
    $clientes = Cliente::all();
    $vehiculos = Vehiculo::all();

    return view('ordenes_trabajo.edit', [
    'ordenes_trabajo' => $orden_trabajo,
    'clientes' => $clientes,
    'vehiculos' => $vehiculos,
]);

}

    public function update(Request $request, OrdenTrabajo $orden_trabajo)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'vehiculo_id'    => 'required|exists:vehiculos,id',
            'fecha_ingreso'  => 'required|date',
            'estado'         => 'required|string',
            'descripcion'    => 'nullable|string',
            'observaciones'  => 'nullable|string',
            'total'          => 'nullable|numeric',
        ]);

        $orden_trabajo->update($request->all());

        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden actualizada correctamente.');
    }

public function show($id)
{
    $orden_trabajo = OrdenTrabajo::with('items.producto', 'items.servicio')->findOrFail($id);
    $productos = Producto::all();
    $servicios = Servicio::all();
    $formasPago = FormaPago::all(); // para el botón de generar venta

    return view('ordenes-trabajo.show', compact('orden_trabajo', 'productos', 'servicios', 'formasPago'));
}


    public function destroy(OrdenTrabajo $orden_trabajo)
    {
        $orden_trabajo->delete();
        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden eliminada correctamente.');
    }
}