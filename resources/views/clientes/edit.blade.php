@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')
        @include('clientes.form', ['cliente' => $cliente])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
