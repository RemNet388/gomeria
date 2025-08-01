@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="section-title">Agregar cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST">
        @include('clientes.form')
        <button type="submit" class="btn btn-success btn-custom">Guardar</button>
    </form>
</div>
@endsection
