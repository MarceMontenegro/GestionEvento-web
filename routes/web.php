<?php

use App\Http\Controllers\AceptanController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InvitacionesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
//nombre de ruta, nombre de controlador, nombre de funcion y ubicacion del metodo
Route::get('/crear-evento',[EventoController::class, 'create'])->name('eventos.create');
Route::post('/crear-evento/store',[EventoController::class, 'store'])->name('eventos.store');
Route::get('/index',[EventoController::class, 'index'])->name('eventos.index');
Route::get('/index/configuracion/{ID_eventos}',[EventoController::class, 'edit'])->name('eventos.edit');
Route::get('/index/update/{ID_eventos}',[EventoController::class, 'update'])->name('eventos.update');
Route::delete('/index/delete/{ID_eventos}',[EventoController::class, 'destroy'])->name('eventos.destroy');
Route::get('eventos/{ID_eventos}/invitar', [InvitacionesController::class, 'invitar'])->name('invitaciones.invitar');
Route::post('eventos/{ID_eventos}/enviar', [InvitacionesController::class, 'enviarInvitacion'])->name('invitaciones.enviar');
Route::get('invitaciones', [InvitacionesController::class, 'verInvitaciones'])->name('invitaciones.index');
Route::post('invitaciones/{ID_invitaciones}/responder', [InvitacionesController::class, 'responderInvitacion'])->name('invitaciones.responder');
});

require __DIR__.'/auth.php';


