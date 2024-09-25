<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evento_user = Auth::user()->id;
        $eventos = Evento::where('user_id', $evento_user)->get();
        return view('eventos.index', compact('eventos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //verificacion de datos
        // $datos = $request->all();
        // return response()->json($datos);
       // Validar la solicitud
    $request->validate([
        'nombre_evento' => 'required|string',
        'descripcion' => 'required|string',
        'fecha_inicio' => 'required|date',
        'ubicacion' => 'required|string',
        'latitud' => 'required|numeric',
        'longitud' => 'required|numeric',
    ]);

    // Crear un nuevo evento
    Evento::create([
        'nombre_evento' => $request->nombre_evento,
        'descripcion' => $request->descripcion,
        'fecha_inicio' => $request->fecha_inicio,
        'ubicacion' => $request->ubicacion,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'user_id' => Auth::user()->id,
    ]);

    return redirect()->route('welcome')->with('success', 'Evento creado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
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

    
        $evento->update($request->all());
    
        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ID_eventos)
    {
        // Buscar el evento por ID
        $evento = Evento::destroy($ID_eventos);
        

    // Redirigir a la lista de eventos con un mensaje de éxito
    return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}
