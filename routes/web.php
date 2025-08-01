<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ClienteController;

Route::resource('ventas', VentaController::class);
Route::get('caja', [CajaController::class, 'index'])->name('caja.index');
Route::get('caja/cerrar', [CajaController::class, 'cerrar'])->name('caja.cerrar');
Route::post('caja/pdf', [CajaController::class, 'generarPDF'])->name('caja.generarPDF');
Route::post('caja/registrar-cierre', [CajaController::class, 'registrarCierre'])->name('caja.registrarCierre');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class);
});
Route::get('/productos/stock', [ProductoController::class, 'verStock'])->name('productos.stock');
Route::get('/productos/stock/pdf', [ProductoController::class, 'descargarStock'])->name('productos.descargarStock');

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
});

Route::resource('ordenes-trabajo', OrdenTrabajoController::class)->parameters([
    'ordenes-trabajo' => 'orden_trabajo'
]);
Route::resource('servicios', App\Http\Controllers\ServicioController::class);

Route::get('/crear-admin', function () {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@gomeria.com',
        'password' => bcrypt('admin123'),
    ]);
    return 'Usuario creado';
});
Route::resource('formas-pago', \App\Http\Controllers\FormaPagoController::class);


require __DIR__.'/auth.php';
