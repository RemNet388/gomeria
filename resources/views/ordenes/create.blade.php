@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear orden de trabajo</h1>

    <form action="{{ route('ordenes-trabajo.store') }}" method="POST">
        @include('ordenes.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
