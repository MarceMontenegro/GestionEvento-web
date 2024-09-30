@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles del Evento</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $evento->nombre_evento }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fecha de inicio:</strong> {{ $evento->fecha_inicio }}</p>
            <p><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
            
            <!-- Mapa de Google Maps -->
            <div id="map" style="height: 400px; width: 100%;"></div>
        </div>
    </div>

    <a href="{{ route('invitaciones.index') }}" class="btn btn-primary mt-3">Volver a la lista de invitacion</a>
</div>

<!-- Agregar la API de Google Maps -->

<script>
    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: {{ $evento->latitud }}, lng: {{ $evento->longitud }}}, // Coordenadas del evento
            zoom: 17,
            mapTypeId: 'roadmap'
        });

        // Crear un marcador en la ubicación del evento
        new google.maps.Marker({
            position: {lat: {{ $evento->latitud }}, lng: {{ $evento->longitud }}}, // Coordenadas del evento
            map: map,
            title: '{{ $evento->nombre_evento }}'
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeGTxGU_ms5PBkMhSMvvlLnhCFA4MZFNo&libraries=places&callback=initAutocomplete" async defer></script>

@endsection
