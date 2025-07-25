@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar producto</h1>

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')
        @include('productos.form', ['producto' => $producto])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
