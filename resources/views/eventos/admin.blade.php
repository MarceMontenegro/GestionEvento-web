@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('title', 'Dashboard')

@section('content')

<h1>hola {{$evento->nombre_evento}}</h1>
@stop
@section('css')

    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop