@extends('layouts.admin')

@section('contenido')
    <h1>Gestión de Vecinos</h1>

    <div class="card shadow mt-3">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }} {{ $usuario->apellido }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($usuario->rol) }}</span>
                        </td>
                        <td>
                            <span class="badge @if($usuario->estado == 'activo') bg-success @else bg-danger @endif">
                                {{ ucfirst($usuario->estado) }}
                            </span>
                        </td>
                        <td>
                            <!-- Botón para activar/desactivar -->
                            <form action="/admin/usuarios/{{ $usuario->id }}/estado" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm @if($usuario->estado == 'activo') btn-outline-danger @else btn-outline-success @endif">
                                    @if($usuario->estado == 'activo') Desactivar @else Activar @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
