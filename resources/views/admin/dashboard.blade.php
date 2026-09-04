@extends('layouts.admin')

@section('contenido')
    <h1>Resumen de la Comunidad</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3 shadow">
                <h3>{{ $totalReportes }}</h3>
                <p>Total Reportes</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3 shadow">
                <h3>{{ $pendientes }}</h3>
                <p>Pendientes</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3 shadow">
                <h3>{{ $resueltos }}</h3>
                <p>Resueltos</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white p-3 shadow">
                <h3>{{ $totalUsuarios }}</h3>
                <p>Vecinos Registrados</p>
            </div>
        </div>
    </div>
@endsection