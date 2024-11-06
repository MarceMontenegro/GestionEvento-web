@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Invitar usuarios al evento: {{ $evento->nombre_evento }}</h1>
    <form action="{{ route('invitaciones.enviar', $evento->ID_eventos) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="usuarios">Selecciona usuarios para invitar:</label>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>
                            <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}">
                        </td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            <a href={{url()->previous()}} class="btn btn-secondary">Volver atrás</a>
            <button type="submit" class="btn btn-primary">Enviar invitaciones</button>
    </div>
    </form>
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