@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Vehículo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('vehiculos.form')
    </form>
</div>
@endsection
