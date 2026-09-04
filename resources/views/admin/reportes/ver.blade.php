@extends('layouts.admin')

@section('contenido')
    <a href="/admin/reportes" class="btn btn-secondary mb-3">⬅️ Volver al listado</a>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Detalle del Reporte #{{ $reporte->id }}</h4>
                </div>
                <div class="card-body">
                    <h3>{{ $reporte->titulo }}</h3>
                    <p class="text-muted">Reportado por: <strong>{{ $reporte->usuario->name }} {{ $reporte->usuario->apellido }}</strong></p>
                    <hr>
                    <h5>Descripción:</h5>
                    <p>{{ $reporte->descripcion }}</p>
                    <hr>
                    <p><strong>Categoría:</strong> {{ $reporte->categoria->nombre }}</p>
                    <p><strong>Dirección:</strong> {{ $reporte->direccion ?? 'No especificada' }}</p>
                    <p><strong>Fecha:</strong> {{ $reporte->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Gestionar Estado</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/reportes/{{ $reporte->id }}/estado" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Cambiar estado a:</label>
                            <select name="estado" class="form-select">
                                <option value="pendiente" {{ $reporte->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="revision" {{ $reporte->estado == 'revision' ? 'selected' : '' }}>En Revisión</option>
                                <option value="proceso" {{ $reporte->estado == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="resuelto" {{ $reporte->estado == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                                <option value="rechazado" {{ $reporte->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Actualizar Estado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection