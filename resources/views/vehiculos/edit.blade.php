@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar vehículo</h1>

    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
        @csrf
        @method('PUT')
        @include('vehiculos.form', ['vehiculo' => $vehiculo])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
