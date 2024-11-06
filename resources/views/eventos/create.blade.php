@extends('adminlte::page')



@section('content')

    <div class="container">
        
{{-- Logo --}}
        
        
        <div class="div">
            <div class="col-md-12">
                {{-- Card Box --}}
                <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}" 
                style="box-shadow: 5px 5px 5px 5px #cccccc">
            </div>
        </div>
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none text-center">
                    <b>Mis eventos</b>
                </h3>
            </div>
    
            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="{{ route('eventos.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_evento">Nombre</label>
                                <input type="text" name="nombre_evento" class="form-control" value="{{ old('nombre_evento') }}" required>
                                @error('nombre_evento')
                                    <span class="text-danger">{{ $message }}</span>
                                    <script>
                                        document.querySelector('input[name="nombre_evento"]').value = ''; // Vacía el campo si hay error
                                    </script>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
                                @error('descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                    <script>
                                        document.querySelector('input[name="descripcion"]').value = ''; // Vacía el campo si hay error
                                    </script>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                                @error('fecha_inicio')
                                    <span class="text-danger">{{ $message }}</span>
                                    <script>
                                        document.querySelector('input[name="fecha_inicio"]').value = ''; // Vacía el campo si hay error
                                    </script>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input id="pac-input" class="form-control" name="ubicacion" type="text" placeholder="Buscar..." value="{{ old('ubicacion') }}" required>
                                <input type="hidden" name="latitud" id="latitud" value="{{ old('latitud') }}" required>
                                <input type="hidden" name="longitud" id="longitud" value="{{ old('longitud') }}" required>
                                <br>
                                <div id="map" style="width: 100%;height: 400px"></div>
                            </div>
                            @error('ubicacion')
                                <span class="text-danger">{{ $message }}</span>
                                <script>
                                    document.querySelector('input[name="ubicacion"]').value = ''; // Vacía el campo si hay error
                                </script>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-5">
                            <a href="{{ url()->previous() }}" class="btn-lg btn-secondary btn-block"><center>Cancelar</center></a>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <button type="submit" class="btn-lg btn-primary btn-block">Crear evento</button>
                        </div>
                    </div>
                    
                </form>
                
            </div>
<br>
            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif

        </div>

    </div>
@endsection
@section('footer')
    <footer class="main-footer">
        <strong>&copy; 2024 Gestión de eventos</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
@stop
@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeGTxGU_ms5PBkMhSMvvlLnhCFA4MZFNo&libraries=places&callback=initAutocomplete" async defer></script>
    
        <script>
        
        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -29.144701, lng: -59.264786}, //
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            
            // Enlazar el campo de búsqueda al mapa
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }

                // Limpiar los marcadores anteriores
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                var bounds = new google.maps.LatLngBounds();
                
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    // Establecer latitud y longitud en los campos ocultos
                    document.getElementById('latitud').value = place.geometry.location.lat();
                    document.getElementById('longitud').value = place.geometry.location.lng();

                    // Crear un marcador para el lugar seleccionado
                    markers.push(new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        </script>
@stop
