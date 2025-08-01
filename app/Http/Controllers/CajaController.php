<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $fecha = $request->input('fecha', now()->toDateString());

        $ventas = Venta::with('cliente', 'formaPago')
            ->whereDate('fecha', $fecha)
            ->orderBy('fecha', 'desc')
            ->get();

        $total = $ventas->sum('total');

        return view('caja.index', compact('ventas', 'fecha', 'total'));
    }

    public function cerrar(Request $request)
    {
        $fecha = $request->input('fecha', now()->toDateString());

        $ventas = Venta::with('cliente', 'formaPago')
            ->whereDate('fecha', $fecha)
            ->orderBy('fecha', 'asc')
            ->get();

        $total = $ventas->sum('total');

        // Acá podrías generar un PDF o vista imprimible
        return view('caja.resumen', compact('ventas', 'fecha', 'total'));
    }
    
public function generarPDF()
{
    $ventas = Venta::whereDate('fecha', today())->get();
    $total = $ventas->sum('total');

    $pdf = Pdf::loadView('caja.resumen-pdf', compact('ventas', 'total'));

    return $pdf->download('resumen-caja-' . now()->format('Ymd') . '.pdf');
}

}
