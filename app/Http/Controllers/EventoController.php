<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Invitaciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request, $categoria = null)
    // {
    //     if ($categoria) {
    //         $eventos = Evento::where('categoria', $categoria)->get();
    //     } else {
    //         // Si no se pasa una categoría, mostramos todos los eventos
    //         $eventos = Evento::all();
    //     }

    //     $evento_user = Auth::user()->id;

    
    //     foreach ($eventos as $evento) {
    //         $evento->participantes_aceptados = Invitaciones::where('ID_eventos', $evento->ID_eventos)
    //             ->where('estado', 1) // Estado 1 = aceptado
    //             ->with('usuario')
    //             ->get();
    //         $evento->participantes_rechazados = Invitaciones::where('ID_eventos', $evento->ID_eventos)
    //             ->where('estado', 2) // Estado 2 = rechazado
    //             ->with('usuario')
    //             ->get();
    //         $evento->participantes_pendientes = Invitaciones::where('ID_eventos', $evento->ID_eventos)
    //             ->where('estado', 0) // Estado 0 = pendiente
    //             ->with('usuario')
    //             ->get();
            
    //     }

    //     return view('eventos.index', compact('eventos'));
    // }

    public function index(Request $request, $categoria = null)
    {
        $perPage = 5; // Número de eventos por página

        if ($categoria) {
            $eventos = Evento::where('categoria', $categoria)->paginate($perPage);
        } else {
            // Aplicar paginación a todos los eventos
            $eventos = Evento::paginate($perPage);
        }

        $evento_user = Auth::user()->id;

        foreach ($eventos as $evento) {
            $evento->participantes_aceptados = Invitaciones::where('ID_eventos', $evento->ID_eventos)
                ->where('estado', 1) 
                ->with('usuario')
                ->get();

            $evento->participantes_rechazados = Invitaciones::where('ID_eventos', $evento->ID_eventos)
                ->where('estado', 2) 
                ->with('usuario')
                ->get();

            $evento->participantes_pendientes = Invitaciones::where('ID_eventos', $evento->ID_eventos)
                ->where('estado', 0) 
                ->with('usuario')
                ->get();
        }

        // Retornar la vista con los eventos paginados
        return view('eventos.index', compact('eventos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eventos.create');
    }

    

    public function store(Request $request)
{
    
    // Validación
    $request->validate([
        'nombre_evento' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
        'descripcion' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:500'],
        'fecha_inicio' => ['required', 'date'],
        'ubicacion' => ['required', 'string'],
        'latitud' => ['required', 'numeric'],
        'longitud' => ['required', 'numeric'],
        'categoria' => ['required', 'in:deportes,fiestas,negocios,academicos'],  // Validación estricta para categoría
    ], [
        'categoria.required' => 'Por favor, selecciona una categoría.',  // Error si no se selecciona
        'categoria.in' => 'La categoría seleccionada no es válida.',  // Error si el valor no es válido
    ]);

    // Crear el evento
    Evento::create([
        'nombre_evento' => $request->nombre_evento,
        'descripcion' => $request->descripcion,
        'fecha_inicio' => $request->fecha_inicio,
        'categoria' => $request->categoria,
        'ubicacion' => $request->ubicacion,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
         // Aseguramos que se guarde el valor seleccionado
        'user_id' => Auth::user()->id,
    ]);

    return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente.');
}




    /**
     * Display the specified resource.
     */
    public function show($ID_eventos)
    {
    // Buscar el evento por su ID
    $evento = Evento::findOrFail($ID_eventos);

    // Retornar la vista con los detalles del evento
    return view('eventos.show', compact('evento'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ID_eventos)
    {
        $evento = Evento::find($ID_eventos);
    

    
        return view('eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ID_eventos)
    {
        $evento = Evento::find($ID_eventos);
        
        $request->validate([
            'nombre_evento' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],  // Solo permite letras y espacios
            'descripcion' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:500'],
            'fecha_inicio' => ['required', 'date'],
            'ubicacion' => ['required', 'string'],
            'latitud' => ['required', 'numeric'],
            'longitud' => ['required', 'numeric'],
        ]);
    
        $evento->update($request->all());
    
        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente');
    }

    public function mostrarUnEvento($id)
{
    $evento = Evento::findOrFail($id); // Trae solo un evento
    return view('eventos.index', compact('evento'));
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ID_eventos)
    {
        // Buscar el evento por ID
        Evento::destroy($ID_eventos);
        

    // Redirigir a la lista de eventos con un mensaje de éxito
    return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }

    public function agregarModerador($eventoId)
    {
        $evento = Evento::findOrFail($eventoId);
        $usuarios = User::whereDoesntHave('moderandoEventos', function ($query) use ($evento) {
            $query->where('evento_id', $evento->ID_eventos);
        })->where('id', '!=', Auth::user()->id)->get(); // Excluye al usuario actual
        

        return view('usuarios.agregarModerador', compact('evento', 'usuarios'));
    }

    public function asignarModerador($eventoId, $usuarioId)
    {
        $evento = Evento::findOrFail($eventoId);
        $usuario = User::findOrFail($usuarioId);

        // Añadir al usuario como moderador del evento
        $evento->moderadores()->attach($usuario);

        return redirect()->route('eventos.index')->with('success', 'Moderador agregado correctamente.');
    }

    public function eventosModerados()
    {
        
        $usuario = Auth::user();
        $eventos = $usuario->moderandoEventos;//se accede al modelo usuarios y se usa moderandoEventos donde se lo relaciona con el evento que le corresponde o asignaron
    
        return view('usuarios.evento', compact('eventos'));
    }
 

}
