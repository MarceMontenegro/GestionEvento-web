@extends('adminlte::page')

@section('content')
<div class="container">
    <center><h1>Detalles del Evento</h1></center>
    
    <div class="card">
        <div class="card-header">
            <h2>Nombre: {{ $evento->nombre_evento }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fecha de inicio:</strong> {{ $evento->fecha_inicio }}</p>
            <p><strong>Ubicación:</strong> {{ $evento->ubicacion }}</p>
            
            <!-- Mapa de Google Maps -->
            <div id="map" style="height: 400px; width: 100%;"></div>
            <br>
            <a href="{{ route('invitaciones.index') }}" class="btn btn-secondary btn-lg" style="width: 150px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                  </svg>
            </a>

        </div>
    </div>

    <br>
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
@section('footer')
    <footer class="main-footer">
        <strong>&copy; 2024 Gestión de eventos</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
@stop
