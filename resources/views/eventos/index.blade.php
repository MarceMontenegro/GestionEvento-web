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
                            {{-- Enlace para invitar al evento --}}
                            <a href="{{ route('invitaciones.invitar', $evento->ID_eventos) }}" class="btn btn-primary">Invitar</a>

                            {{-- Enlace para editar el evento --}}
                            <a href="{{ route('eventos.edit', $evento->ID_eventos) }}" class="btn btn-warning" >Editar</a>

                            {{-- Botón para eliminar el evento --}}
                            <form action="{{ route('eventos.destroy', $evento->ID_eventos) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Mensaje si no hay eventos --}}
        @if ($eventos->isEmpty())
            <p>No tienes eventos registrados.</p>
        @endif
    </div>
@endsection
