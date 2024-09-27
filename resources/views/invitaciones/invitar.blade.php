@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Invitar usuarios al evento: {{ $evento->nombre_evento }}</h1>
    <form action="{{ route('invitaciones.enviar', $evento->ID_eventos) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="usuarios">Selecciona usuarios para invitar:</label>
            <select name="usuarios[]" id="usuarios" class="form-control" multiple>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar invitaciones</button>
    </form>
</div>
@endsection
