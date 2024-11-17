@extends('adminlte::page')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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
    


    <div class="d-flex justify-content-between align-items-center mb-4">
       
@php
    $id=Auth::user()->id;
@endphp
        <h1 class="display-4">Mis eventos</h1>
        <a href="{{ route('usuario.evento',['usuario_id' => $id]) }}" class="btn btn-primary btn-lg">Moderar Eventos
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                <path d="M16 4.5a4.5 4.5 0 0 1-1.703 3.526L13 5l2.959-1.11q.04.3.041.61"/>
                <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.5 4.5 0 0 0 11.5 9m-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376M3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
              </svg>
        </a>
        <a href="{{ route('eventos.create') }}" class="btn btn-primary btn-lg">Nuevo evento 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
              </svg>
        </a>
        <div class="mb-3">
            <button class="btn btn-primary dropdown-toggle" type="button" id="filtroButton" data-bs-toggle="dropdown" aria-expanded="false">
                Filtro
            </button>
            <ul class="dropdown-menu" aria-labelledby="filtroButton">
                <li><a class="dropdown-item" href="{{ route('eventos.filtro', ['categoria' => 'deportes']) }}">Deportes</a></li>
                <li><a class="dropdown-item" href="{{ route('eventos.filtro', ['categoria' => 'fiestas']) }}">Fiestas</a></li>
                <li><a class="dropdown-item" href="{{ route('eventos.filtro', ['categoria' => 'academicos']) }}">Académicos</a></li>
                <li><a class="dropdown-item" href="{{ route('eventos.filtro', ['categoria' => 'negocios']) }}">Negocios</a></li>
                <li><a class="dropdown-item" href="{{ route('eventos.index') }}">Todos</a></li> <!-- Opción para mostrar todos -->
            </ul>
        </div>
        
        
    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre del Evento</th>
                    <th>Descripción</th>
                    <th>Fecha de Inicio</th>
                    <th>Ubicación</th>
                    <th>Categoría</th>
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
                        <td>{{ $evento->categoria }}</td>
                        <td>
                            {{-- boton invitar --}}
                            <a href="{{ route('invitaciones.invitar', $evento->ID_eventos) }}" class="btn btn-primary" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                              </svg></a>
                              {{-- boton editar --}}
                            <a href="{{ route('eventos.edit', $evento->ID_eventos) }}" class="btn btn-warning" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                              </svg></a>
                            {{-- boton eliminar --}}
                            <form action="{{ route('eventos.destroy', $evento->ID_eventos) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                @csrf
                                {{method_field('DELETE')}}
                                
                                <button type="submit" class="btn btn-danger" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                  </svg></button>
                            </form>
                    
                        </svg></a>
                      
                        
                        <a href="{{ route('evento.agregarModerador', ['eventoId' => $evento->ID_eventos]) }}" class="btn btn-secondary mb-1">
                            Agregar Moderador
                        </a>
                    
        
                        </td>
                        <td>
                            {{-- Desplegar participantes por estado --}}
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#participantes-{{ $evento->ID_eventos }}" aria-expanded="false" aria-controls="participantes-{{ $evento->ID_eventos }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                  </svg>
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
            <h2>
                <b>No tienes eventos registrados.</b>
            </h2>
        @endif
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
@section('cs')

@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@stop
