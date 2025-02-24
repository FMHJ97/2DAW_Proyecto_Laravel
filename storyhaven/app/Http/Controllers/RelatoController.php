<?php

namespace App\Http\Controllers;

use App\Models\Relato;
use App\Models\User;
use App\Models\Genero;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RelatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtenemos los datos del usuario autenticado.
        $autenticado = User::find(Auth::id());
        // Obtenemos los relatos del usuario autenticado ordenados por fecha de publicación (recientes primero).
        // Para ello, usamos el método relatos() que hemos definido en el modelo User.
        $relatos = $autenticado->relatos()->OrderBy('fecha_publicacion', 'desc')->get();
        // Retornamos la vista 'relatos.index' con los relatos obtenidos.
        return view('relatos.index')->with('relatos', $relatos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtenemos todos los géneros literarios de la base de datos.
        $generos = Genero::all();
        // Retornamos la vista 'relatos.create' con los géneros obtenidos.
        return view('relatos.create')->with('generos', $generos);
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
    public function show(Relato $relato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relato $relato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relato $relato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relato $relato)
    {
        //
    }

}
