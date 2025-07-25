<?php

namespace App\Http\Controllers;

use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class OrdenTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::with('vehiculo.cliente')->get();
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('ordenes.create', compact('vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'detalle' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'fecha_entrada' => 'nullable|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
        ]);

        OrdenTrabajo::create($request->all());

        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden creada correctamente.');
    }

    public function edit(OrdenTrabajo $orden)
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('ordenes.edit', compact('orden', 'vehiculos'));
    }

    public function update(Request $request, OrdenTrabajo $orden)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'detalle' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'fecha_entrada' => 'nullable|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
        ]);

        $orden->update($request->all());

        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden actualizada correctamente.');
    }

    public function destroy(OrdenTrabajo $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes-trabajo.index')->with('success', 'Orden eliminada.');
    }
}
