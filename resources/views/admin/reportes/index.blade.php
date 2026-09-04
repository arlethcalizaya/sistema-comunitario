@extends('layouts.admin')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Listado de Reportes Comunitarios</h1>
    </div>

    <div class="card shadow mt-3">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Vecino</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->usuario->name }}</td>
                        <td>{{ $reporte->titulo }}</td>
                        <td>{{ $reporte->categoria->nombre }}</td>
                        <td>
                            <span class="badge @if($reporte->estado == 'pendiente') bg-warning @else bg-success @endif">
                                {{ ucfirst($reporte->estado) }}
                            </span>
                        </td>
                        <td>{{ $reporte->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="/admin/reportes/{{ $reporte->id }}" class="btn btn-sm btn-info text-white">Ver Detalles</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection