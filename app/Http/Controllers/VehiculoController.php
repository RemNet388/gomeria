<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;


class VehiculoController extends Controller
{
    public function index()
{
    $vehiculos = Vehiculo::all();
    return view('vehiculos.index', compact('vehiculos'));
}

public function create()
{
    return view('vehiculos.create');
}

public function store(Request $request)
{
    $request->validate([
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'logo' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['marca', 'modelo']);

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('vehiculos', 'public');
    }

    Vehiculo::create($data);

    return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
}

public function edit(Vehiculo $vehiculo)
{
    return view('vehiculos.edit', compact('vehiculo'));
}

public function update(Request $request, Vehiculo $vehiculo)
{
    $request->validate([
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'logo' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['marca', 'modelo']);

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('vehiculos', 'public');
    }

    $vehiculo->update($data);

    return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado.');
}

public function destroy(Vehiculo $vehiculo)
{
    $vehiculo->delete();
    return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado.');
}

}
