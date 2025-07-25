<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('vehiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'patente' => 'required|string|max:20|unique:vehiculos,patente',
            'anio' => 'nullable|string|max:4',
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
    }

    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::all();
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'patente' => 'required|string|max:20|unique:vehiculos,patente,' . $vehiculo->id,
            'anio' => 'nullable|string|max:4',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado.');
    }
}
