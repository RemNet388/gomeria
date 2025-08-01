<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    public function index()
    {
        $formas = FormaPago::all();
        return view('formas_pago.index', compact('formas'));
    }

    public function create()
    {
        return view('formas_pago.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        FormaPago::create($request->all());

        return redirect()->route('formas-pago.index')->with('success', 'Forma de pago creada correctamente.');
    }

    public function edit(FormaPago $formas_pago)
    {
        return view('formas_pago.edit', ['forma' => $formas_pago]);
    }

    public function update(Request $request, FormaPago $formas_pago)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $formas_pago->update($request->all());

        return redirect()->route('formas-pago.index')->with('success', 'Forma de pago actualizada.');
    }

    public function destroy(FormaPago $formas_pago)
    {
        $formas_pago->delete();
        return redirect()->route('formas-pago.index')->with('success', 'Forma de pago eliminada.');
    }
}
