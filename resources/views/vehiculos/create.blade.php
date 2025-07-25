@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar vehículo</h1>

    <form action="{{ route('vehiculos.store') }}" method="POST">
        @include('vehiculos.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
