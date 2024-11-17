@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('title', 'Dashboard')

@section('content')


<div class="jumbotron bg-primary text-white">
    <h1 class="display-4">¡Bienvenido al Panel de Gestión de Eventos!</h1>
    <p class="lead">Administra, organiza y personaliza tus eventos de forma fácil y rápida. Accede a las funcionalidades principales desde este panel.</p>
    <hr class="my-4 bg-light">
    <p>Usa los botones de abajo para comenzar a crear eventos, gestionar invitaciones y mucho más.</p>
</div>

<!-- Botones principales -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <i class="fas fa-calendar-plus fa-3x"></i>
                <p>Crear Eventos</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <a href={{route('eventos.create')}} class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <i class="fas fa-envelope fa-3x"></i>
                <p>Invitaciones</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href={{route('invitaciones.index')}} class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <i class="fas fa-calendar-alt fa-3x"></i>
                <p>Mis Eventos</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href={{route('eventos.index')}} class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <i class="fas fa-user fa-3x"></i>
                <p>Mi Perfil</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="{{route('profile.edit')}}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

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
        <strong>&copy; 2024 Gestión de eventos</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 1.0.0
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
