@extends('layouts.admin')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📍 Mapa de Problemas Comunitarios</h1>
        <span class="badge bg-white text-dark shadow-sm p-2">
            🔴 Pendientes | 🟢 Resueltos
        </span>
    </div>

    <!-- Contenedor del mapa -->
    <div id="mapa-comunidad" style="height: 600px; border-radius: 15px; border: 2px solid #ddd; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></div>

    <!-- Cargar Leaflet desde internet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // 1. Configuración de los Iconos de Colores
        // Icono Rojo (Para problemas pendientes)
        var iconoRojo = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Icono Verde (Para problemas resueltos)
        var iconoVerde = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // 2. Inicializar el mapa (centrado en tu ciudad)
        // Puedes cambiar [-17.3935, -66.1570] por las coordenadas de tu barrio
        var map = L.map('mapa-comunidad').setView([-17.3935, -66.1570], 13);

        // 3. Cargar las imágenes del mapa (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // 4. Traer los reportes de la base de datos a través de nuestra API
        fetch('/api/mapa/reportes')
            .then(response => response.json())
            .then(data => {
                data.forEach(reporte => {
                    
                    // Elegir el icono según el estado
                    // Si el estado es 'resuelto', usa verde. Si no, usa rojo.
                    var iconoAUsar = (reporte.estado === 'resuelto') ? iconoVerde : iconoRojo;

                    // Crear el marcador (el globito)
                    var marker = L.marker([reporte.latitud, reporte.longitud], { icon: iconoAUsar }).addTo(map);
                    
                    // Crear el contenido de la ventanita (Popup)
                    var contenidoPopup = `
                        <div style="width: 200px; font-family: sans-serif;">
                            <h6 style="margin-bottom: 5px; font-weight: bold; color: #333;">${reporte.titulo}</h6>
                            <p style="margin-bottom: 8px; font-size: 12px; color: #666;">
                                <b>Categoría:</b> ${reporte.categoria.nombre}
                            </p>
                            <div style="margin-bottom: 10px;">
                                <span style="
                                    padding: 3px 8px; 
                                    border-radius: 10px; 
                                    font-size: 10px; 
                                    color: white; 
                                    background-color: ${reporte.estado === 'resuelto' ? '#28a745' : '#dc3545'};
                                ">
                                    ${reporte.estado.toUpperCase()}
                                </span>
                            </div>
                            <a href="/admin/reportes/${reporte.id}" 
                               style="
                                    display: block; 
                                    text-align: center; 
                                    background: #0d6efd; 
                                    color: white; 
                                    text-decoration: none; 
                                    padding: 5px; 
                                    border-radius: 5px; 
                                    font-size: 12px;
                               ">
                               Ver detalles completos
                            </a>
                        </div>
                    `;
                    
                    // Conectar la ventanita al marcador
                    marker.bindPopup(contenidoPopup);
                });
            })
            .catch(error => console.error('Error al cargar el mapa:', error));
    </script>
@endsection