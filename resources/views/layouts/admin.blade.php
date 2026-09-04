<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Comunidad Activa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #212529; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #343a40; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <h4 class="text-center">🏘️ Dirigente</h4>
                <hr>
                <a href="/admin/mapa">🗺️ Mapa Comunitario</a>
                <a href="/admin/dashboard">📊 Dashboard</a>
                <a href="/admin/reportes">🚨 Ver Reportes</a>
                <a href="/admin/usuarios">👥 Usuarios</a>
                <a href="/logout" class="text-danger mt-auto">🚪 Cerrar Sesión</a>
            </nav>
            
            <main class="col-md-10 p-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @yield('contenido')
            </main>
        </div>
    </div>
</body>
</html>