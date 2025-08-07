@extends('layouts.app')

@section('content')
<h1>Mis Multas</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($multas->isEmpty())
    <p>No tienes multas pendientes o registradas.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Monto</th>
            <th>Motivo</th>
            <th>Pagada</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($multas as $multa)
        <tr>
            <td>Q {{ number_format($multa->monto, 2) }}</td>
            <td>{{ $multa->motivo }}</td>
            <td>
                @if($multa->pagada)
                    <span class="badge bg-success">Sí</span>
                @else
                    <span class="badge bg-danger">No</span>
                @endif
            </td>
            <td>
                @if(!$multa->pagada)
                    <form action="{{ route('multas.pagar', $multa->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('¿Deseas pagar esta multa?')">
                            Pagar
                        </button>
                    </form>
                @else
                    <button class="btn btn-sm btn-secondary" disabled>Pagada</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
