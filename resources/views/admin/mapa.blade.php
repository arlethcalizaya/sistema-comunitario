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
        // 1. Centrar el mapa (puedes ajustar las coordenadas a tu ciudad)
        var map = L.map('mapa-comunidad').setView([-17.3935, -66.1570], 13);

        // 2. Cargar el diseño del mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 3. Traer los datos de nuestra API
        fetch('/api/mapa/reportes')
            .then(response => response.json())
            .then(data => {
                data.forEach(reporte => {
                    // Crear un globito (marcador) por cada reporte
                    var marker = L.marker([reporte.latitud, reporte.longitud]).addTo(map);
                    
                    // Al hacer clic, muestra el título y un enlace
                    marker.bindPopup(`
                        <b>${reporte.titulo}</b><br>
                        Estado: ${reporte.estado}<br>
                        <a href="/admin/reportes/${reporte.id}" class="btn btn-sm btn-primary text-white mt-2">Ver Detalle</a>
                    `);
                });
            });
    </script>
@endsection