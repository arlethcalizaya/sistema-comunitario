@extends('layouts.usuario')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🚨 Crear Nuevo Reporte</h4>

                    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Ops! Revisa los siguientes campos:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                </div>
                <div class="card-body">
                    <form action="/reportes-web" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Título del problema</label>
                                    <input type="text" name="titulo" class="form-control" placeholder="Ej: Bache profundo" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        <option value="">Selecciona una...</option>
                                        @foreach($categorias as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
                                </div>

                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">📸 Fotografía del problema (Obligatorio)</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    <div class="form-text">Sube una imagen clara para que el dirigente pueda evaluarla mejor.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ubicación (Haz clic en el mapa)</label>
                                <div id="mapa-picker" style="height: 300px; border: 1px solid #ccc;" class="mb-2"></div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="latitud" id="lat" class="form-control" placeholder="Latitud" readonly required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="longitud" id="lng" class="form-control" placeholder="Longitud" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success btn-lg w-100">Enviar Reporte a la Comunidad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet para seleccionar ubicación -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('mapa-picker').setView([-17.3935, -66.1570], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var marker;

        map.on('click', function(e) {
            if (marker) { map.removeLayer(marker); }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        });
    </script>
@endsection