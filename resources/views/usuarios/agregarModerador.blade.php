@extends('adminlte::page')
@section('content')
    <div class="container">
        <h2>Selecciona un usuario para agregar como moderador</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            
                            <ul>
                                <form action="{{ route('moderador.agregar', ['eventoId' => $evento->ID_eventos, 'usuarioId' => $usuario->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit">Agregar como Moderador</button>
                                </form>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
