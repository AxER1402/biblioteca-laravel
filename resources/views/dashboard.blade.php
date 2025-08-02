@extends('layouts.app')

@section('content')
<h1>📚 Panel Principal</h1>
<hr>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text display-6">{{ $totalUsuarios }}</p>
                <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Libros</h5>
                <p class="card-text display-6">{{ $totalLibros }}</p>
                <a href="{{ route('libros.index') }}" class="btn btn-light btn-sm">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Préstamos Activos</h5>
                <p class="card-text display-6">{{ $prestamosActivos }}</p>
                <a href="{{ route('prestamos.index') }}" class="btn btn-light btn-sm">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Multas Pendientes</h5>
                <p class="card-text display-6">{{ $multasPendientes }}</p>
                <a href="{{ route('multas.index') }}" class="btn btn-light btn-sm">Ver</a>
            </div>
        </div>
    </div>
</div>
@endsection
