@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Mis invitaciones</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Fecha de envío</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invitaciones as $invitacion)
            <tr>
                <td>{{ $invitacion->evento->nombre_evento }}</td>
                <td>{{ $invitacion->fecha_envio }}</td>
                <td>
                    @if ($invitacion->estado == 0)
                        Pendiente
                    @elseif ($invitacion->estado == 1)
                        Aceptada
                    @else
                        Rechazada
                    @endif
                </td>
                <td>
                    @if ($invitacion->estado == 0)
                        <form action="{{ route('invitaciones.responder', $invitacion->ID_invitaciones) }}" method="POST">
                            @csrf
                            <button name="estado" value="1" class="btn btn-success">Aceptar</button>
                            <button name="estado" value="2" class="btn btn-danger">Rechazar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
