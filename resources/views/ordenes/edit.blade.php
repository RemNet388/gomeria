@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar orden de trabajo</h1>

    <form action="{{ route('ordenes-trabajo.update', $orden) }}" method="POST">
        @csrf
        @method('PUT')
        @include('ordenes.form', ['orden' => $orden])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
