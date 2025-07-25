@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar producto</h1>

    <form action="{{ route('productos.store') }}" method="POST">
        @include('productos.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
