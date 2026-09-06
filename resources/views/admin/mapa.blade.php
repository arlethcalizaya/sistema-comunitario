@extends('layouts.admin')

@section('contenido')
    <h1>Mapa de Problemas Comunitarios</h1>
    <p class="text-muted">Haz clic en los marcadores para ver los detalles del reporte.</p>

    <!-- Caja donde se verá el mapa -->
    <div id="mapa-comunidad" style="height: 600px; border-radius: 15px; border: 2px solid #ddd;"></div>

    <!-- Cargar CSS y JS de Leaflet (Gratis) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>


// Traer los datos de nuestra API
fetch('/api/mapa/reportes')
    .then(response => response.json())
    .then(data => {
        data.forEach(reporte => {
            // 1. Definir el color según el estado
            let colorIcono = (reporte.estado === 'resuelto') ? 'green' : 'red';
            
            // 2. Crear el marcador en la ubicación exacta
            var marker = L.marker([reporte.latitud, reporte.longitud]).addTo(map);
            
            // 3. Crear el contenido de la ventanita (Popup)
            let contenido = `
                <div style="width: 200px;">
                    <h6 class="fw-bold mb-1">${reporte.titulo}</h6>
                    <p class="small mb-2 text-muted">Categoría: ${reporte.categoria.nombre}</p>
                    <div class="mb-2">
                        <span class="badge ${reporte.estado === 'resuelto' ? 'bg-success' : 'bg-danger'}">
                            ${reporte.estado.toUpperCase()}
                        </span>
                    </div>
                    <a href="/admin/reportes/${reporte.id}" class="btn btn-sm btn-primary w-100 text-white">
                        Ver detalles completos
                    </a>
                </div>
            `;
            
            marker.bindPopup(contenido);
        });
    });



        // 1. Centrar el mapa (puedes ajustar las coordenadas a tu ciudad)
        var map = L.map('mapa-comunidad').setView([-17.3935, -66.1570], 13);

        // 2. Cargar el diseño del mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        
    </script>
@endsection