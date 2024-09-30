@extends('adminlte::page')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
    });
</script>
@endif

    <div class="container">
        
        <h1>Mis eventos</h1>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre del Evento</th>
                    <th>Descripción</th>
                    <th>Fecha de Inicio</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                    <th>Participantes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->nombre_evento }}</td>
                        <td>{{ $evento->descripcion }}</td>
                        <td>{{ $evento->fecha_inicio }}</td>
                        <td>{{ $evento->ubicacion }}</td>
                        <td>
                            <a href="{{ route('eventos.edit', $evento->ID_eventos) }}" class="btn btn-primary" >Invitar</a>
                            <a href="{{ route('eventos.edit', $evento->ID_eventos) }}" class="btn btn-warning" >Editar</a>

                            <form action="{{ route('eventos.destroy', $evento->ID_eventos) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            {{-- Desplegar participantes por estado --}}
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#participantes-{{ $evento->ID_eventos }}" aria-expanded="false" aria-controls="participantes-{{ $evento->ID_eventos }}">
                                Ver Participantes
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="collapse" id="participantes-{{ $evento->ID_eventos }}">
                                <div class="card card-body">
                                    {{-- Aceptados --}}
                                    <h5>Participantes Aceptados:</h5>
                                    @if($evento->participantes_aceptados->isEmpty())
                                        <p>No hay participantes que hayan aceptado la invitación.</p>
                                    @else
                                        <ul>
                                            @foreach($evento->participantes_aceptados as $aceptado)
                                                <li>{{ $aceptado->usuario->name }} ({{ $aceptado->usuario->email }})</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- Rechazados --}}
                                    <h5>Participantes Rechazados:</h5>
                                    @if($evento->participantes_rechazados->isEmpty())
                                        <p>No hay participantes que hayan rechazado la invitación.</p>
                                    @else
                                        <ul>
                                            @foreach($evento->participantes_rechazados as $rechazado)
                                                <li>{{ $rechazado->usuario->name }} ({{ $rechazado->usuario->email }})</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- Pendientes --}}
                                    <h5>Participantes Pendientes:</h5>
                                    @if($evento->participantes_pendientes->isEmpty())
                                        <p>No hay participantes con invitaciones pendientes.</p>
                                    @else
                                        <ul>
                                            @foreach($evento->participantes_pendientes as $pendiente)
                                                <li>{{ $pendiente->usuario->name }} ({{ $pendiente->usuario->email }})</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($eventos->isEmpty())
            <p>No tienes eventos registrados.</p>
        @endif
    </div>
@endsection
