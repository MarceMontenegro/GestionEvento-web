<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('eventos.create')->with('success', 'Evento creado exitosamente.');

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
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
