<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relato;
use App\Http\Requests\RelatoFormRequest;

class APIRelatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtenemos todos los relatos.
        $relatos = Relato::all();
        // Retornamos los relatos en formato JSON.
        return response()->json([
            'status' => 'success',
            'relatos' => $relatos,
            'msg' => 'Relatos obtenidos correctamente.'
        ], 200); // Código de respuesta HTTP 200 OK.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // No vamos a validar los datos en este ejemplo.
        // Creamos un nuevo relato con los datos recibidos.
        $relato = Relato::create($request->all());
        // Retornamos el relato en formato JSON.
        return response()->json([
            'status' => 'success',
            'relato' => $relato,
            'msg' => 'Relato creado correctamente.'
        ], 201); // Código de respuesta HTTP 201 Created.
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtenemos el relato con el ID especificado.
        $relato = Relato::find($id);
        // Si no se encontró el relato, retornamos un mensaje de error.
        if (!$relato) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Relato no encontrado.'
            ], 404); // Código de respuesta HTTP 404 Not Found.
        }
        // Retornamos el relato en formato JSON.
        return response()->json([
            'status' => 'success',
            'relato' => $relato,
            'msg' => 'Relato obtenido correctamente.'
        ], 200); // Código de respuesta HTTP 200 OK.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtenemos el relato con el ID especificado.
        $relato = Relato::find($id);
        // Si no se encontró el relato, retornamos un mensaje de error.
        if (!$relato) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Relato no encontrado.'
            ], 404); // Código de respuesta HTTP 404 Not Found.
        }
        // Actualizamos el relato con los datos recibidos.
        $relato->update($request->all());
        // Retornamos el relato en formato JSON.
        return response()->json([
            'status' => 'success',
            'relato' => $relato,
            'msg' => 'Relato actualizado correctamente.'
        ], 200); // Código de respuesta HTTP 200 OK.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtenemos el relato con el ID especificado.
        $relato = Relato::find($id);
        // Si no se encontró el relato, retornamos un mensaje de error.
        if (!$relato) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Relato no encontrado.'
            ], 404); // Código de respuesta HTTP 404 Not Found.
        }
        // Eliminamos el relato.
        $relato->delete();
        // Retornamos un mensaje de éxito.
        return response()->json([
            'status' => 'success',
            'msg' => 'Relato eliminado correctamente.'
        ], 200); // Código de respuesta HTTP 200 OK.
    }
}
