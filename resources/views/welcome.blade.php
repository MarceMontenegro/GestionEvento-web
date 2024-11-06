@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('title', 'Dashboard')

@section('content')

<h1>Bienvenido al sitema gestion de eventos</h1>



@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
    });
</script>
@endif
@stop
@section('footer')
    <footer class="main-footer">
        <strong>&copy; 2024 Geastion de eventos</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop