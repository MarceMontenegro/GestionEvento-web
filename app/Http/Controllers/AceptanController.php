<?php

namespace App\Http\Controllers;

use App\Models\aceptan;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AceptanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evento_user = Auth::user()->id;
        $evento = Evento::where('ID_eventos', $evento_user)->first();
        return view('eventos.admin', compact('evento'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(aceptan $aceptan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(aceptan $aceptan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, aceptan $aceptan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(aceptan $aceptan)
    {
        //
    }
}
