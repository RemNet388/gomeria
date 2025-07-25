@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST">
        @include('clientes.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
