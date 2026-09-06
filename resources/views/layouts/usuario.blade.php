<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Comunidad - Vecino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-user { background-color: #0d6efd; }
        .footer { background-color: #f8f9fa; padding: 20px 0; margin-top: 50px; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-user shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/dashboard">🏘️ Comunidad Activa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/mis-reportes-web">Mis Reportes</a></li>
                    <li class="nav-item"><a class="btn btn-light ms-lg-3" href="/logout">Cerrar Sesión</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('contenido')
    </div>

    <footer class="footer text-center mt-auto">
        <div class="container">
            <span class="text-muted">© 2026 Sistema de Gestión Comunitaria</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Script de Ventanas Interactivas (SweetAlert2) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('reporte_exitoso'))
    <script>
        Swal.fire({
            title: "¡Reporte Enviado!",
            text: "{{ session('reporte_exitoso') }}",
            icon: "success",
            confirmButtonColor: "#0d6efd"
        });
    </script>
    @endif



</body>
</html>