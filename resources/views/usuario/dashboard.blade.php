@extends('layouts.usuario')

@section('contenido')
    <div class="row mb-4">
        <div class="col">
            <h2>¡Hola, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-muted">Aquí puedes ver el estado de los problemas que has reportado en el barrio.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white text-center p-4">
                <h1 class="display-4 fw-bold text-primary">{{ $total }}</h1>
                <p class="text-muted mb-0">Total Reportados</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white text-center p-4">
                <h1 class="display-4 fw-bold text-warning">{{ $pendientes }}</h1>
                <p class="text-muted mb-0">Aún Pendientes</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white text-center p-4">
                <h1 class="display-4 fw-bold text-success">{{ $resueltos }}</h1>
                <p class="text-muted mb-0">Resueltos con éxito</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Tus reportes recientes</h4>
            <ul class="list-group list-group-flush">
                @forelse($ultimosReportes as $r)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ $r->titulo }}</h6>
                            <small class="text-muted">{{ $r->created_at->diffForHumans() }}</small>
                        </div>
                        <span class="badge @if($r->estado == 'pendiente') bg-warning @else bg-success @endif">
                            {{ ucfirst($r->estado) }}
                        </span>
                    </li>
                @empty
                    <p class="text-center py-3">Aún no has enviado ningún reporte.</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection