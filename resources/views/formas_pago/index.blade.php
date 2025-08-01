@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="section-title">Formas de Pago</h2>
    <a href="{{ route('formas-pago.create') }}" class="btn btn-primary mb-3 btn-custom">Nueva forma</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formas as $forma)
                <tr>
                    <td>{{ $forma->nombre }}</td>
                    <td>
                        <a href="{{ route('formas-pago.edit', $forma) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('formas-pago.destroy', $forma) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger btn-custom" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
