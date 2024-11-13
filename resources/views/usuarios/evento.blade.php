@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Eventos Moderados</h2>

        @if($eventos->isEmpty())
            <p>No estás moderando ningún evento en este momento.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre del Evento</th>
                        <th>Descripción</th>
                        <th>Fecha de Inicio</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventos as $evento)
                        <tr>
                            <td>{{ $evento->nombre_evento }}</td>
                            <td>{{ $evento->descripcion }}</td>
                            <td>{{ $evento->fecha_inicio }}</td>
                            <td>{{ $evento->ubicacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
