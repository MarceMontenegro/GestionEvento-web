<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitacion;
use App\Models\invitaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitacionesController extends Controller
{
    /**
     * Mostrar la vista para invitar usuarios a un evento.
     */
    // public function invitar($ID_eventos)
    // {
    //     $evento = Evento::find($ID_eventos);
    //     // Obtener los usuarios que no son el actual para invitar
    //     $usuarios = User::where('id', '!=', Auth::user()->id)->where('id', '!=', $evento->user_id)    
    //     ->get();

    //     return view('invitaciones.invitar', compact('evento', 'usuarios'));
    // }
   
    public function invitar($ID_eventos)
    {
        $evento = Evento::findOrFail($ID_eventos);
    
        // Obtener usuarios que no sean el actual, el creador del evento, ni los ya invitados
        $usuarios = User::where('id', '!=', Auth::id()) // Excluir usuario actual
            ->where('id', '!=', $evento->user_id)      // Excluir creador del evento
            ->whereDoesntHave('invitaciones', function ($query) use ($evento) {
                $query->where('ID_eventos', $evento->ID_eventos); // Excluir cualquier invitación para este evento
            })
            ->get();
    
        return view('invitaciones.invitar', compact('evento', 'usuarios'));
    }

    /**
     * Enviar las invitaciones a los usuarios seleccionados.
     */
    public function enviarInvitacion(Request $request, $ID_eventos)
    {
        $evento = Evento::find($ID_eventos);
        $usuarios_invitados = $request->input('usuarios');

        foreach ($usuarios_invitados as $usuario_id) {
            invitaciones::create([
                'ID_eventos' => $ID_eventos,
                'user_id' => $usuario_id,
                'fecha_envio' => now(),
                'estado' => 0, // Pendiente
            ]);
        }

        return redirect()->route('eventos.index')->with('success', 'Invitaciones enviadas.');
    }

    /**
     * Ver las invitaciones enviadas al usuario actual.
     */
    public function verInvitaciones()
    {
        $invitaciones = Invitaciones::where('user_id', Auth::id())->get();
        return view('invitaciones.index', compact('invitaciones'));
    }

    /**
     * Responder a una invitación (aceptar o rechazar).
     */
    public function responderInvitacion(Request $request, $ID_invitaciones)
    {
        $invitacion = Invitaciones::find($ID_invitaciones);

        if ($invitacion) {
            $invitacion->update([
                'fecha_respuesta' => now(),
                'estado' => $request->input('estado'),  // 1 = Aceptada, 2 = Rechazada
            ]);
        }

        return redirect()->route('invitaciones.index')->with('success', 'Invitación respondida.');
    }
}
