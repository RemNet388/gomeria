@extends('layouts.app')

@section('content')
<div class="container">
    <h3  class="section-title">Listado de Reparaciones</h3>
    <a href="{{ route('reparaciones.create') }}" class="btn btn-primary mb-3  btn-custom">➕ Nueva Reparación</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Vehículo</th>
                <th>Estado</th>
                <th>Fecha Ingreso</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reparaciones as $reparacion)
    <tr>
        <td>{{ $reparacion->id }}</td>
        <td>{{ $reparacion->cliente->nombre ?? 'Sin cliente' }}</td>
        <td>{{ $reparacion->vehiculo->marca ?? '' }} {{ $reparacion->vehiculo->modelo ?? '' }}</td>
        <td>{{ $reparacion->estado }}</td>
        <td>{{ $reparacion->total }}</td>
        <td>
            <a href="{{ route('reparaciones.show', $reparacion) }}" class="btn btn-sm btn-primary">Ver</a>
            <a href="{{ route('reparaciones.edit', $reparacion) }}" class="btn btn-sm btn-warning">Editar</a>
        </td>
    </tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection
