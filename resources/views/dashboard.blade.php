@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de control</h1>

    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-primary w-100">📦 Productos</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('clientes.index') }}" class="btn btn-outline-primary w-100">👤 Clientes</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-primary w-100">🚗 Vehículos</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('servicios.index') }}" class="btn btn-outline-primary w-100">🚗 Servicios</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('ordenes-trabajo.index') }}" class="btn btn-outline-primary w-100">🛠️ Órdenes de Trabajo</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('ventas.index') }}" class="btn btn-outline-primary w-100">💰 Ventas</a>
        </div>     
    </div>
</div>
@endsection
