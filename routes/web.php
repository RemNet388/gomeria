<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProductoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class);
});

use App\Http\Controllers\ClienteController;

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class);
});

use App\Http\Controllers\VehiculoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
});

use App\Http\Controllers\OrdenTrabajoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('ordenes-trabajo', OrdenTrabajoController::class);
});

require __DIR__.'/auth.php';
