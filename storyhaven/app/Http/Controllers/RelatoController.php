<?php

namespace App\Http\Controllers;

use App\Models\Relato;
use App\Models\User;
use App\Models\Genero;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RelatoController extends Controller
{

    /**
     * Muestra todos los relatos ordenados por fecha de publicación (recientes primero).
     */
    public function getAll()
    {
        // Obtenemos todos los relatos ordenadores por fecha de publicación (recientes primero).
        $relatos = Relato::OrderBy('fecha_publicacion', 'desc')->get();
        // Retornamos la vista 'relatos.all' con los relatos obtenidos.
        return view('relatos.all')->with('relatos', $relatos);
    }

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
        // Validamos los datos del formulario.
        $request->validate([
            'titulo' => 'required|string|max:255', // El título es obligatorio y tiene un máximo de 255 caracteres.
            'resumen' => 'required|string', // El resumen es obligatorio.
            'contenido_pdf' => 'required|file|mimes:pdf', // El contenido es obligatorio y debe ser un archivo PDF.
            'generos' => 'required|array|min:1|max:4', // Se deben seleccionar entre 1 y 4 géneros.
        ]);

        // Creamos un nuevo relato.
        try {
            // Creamos un nuevo relato con los datos recibidos.
            $relato = new Relato();
            $relato->titulo = $request->titulo;
            $relato->resumen = $request->resumen;
            // Guardamos como fecha de publicación la fecha y hora actuales.
            $relato->fecha_publicacion = now();
            // Guardamos el contenido PDF (ruta) en la base de datos.
            $nombre_pdf = time() . "_" . $request->file('contenido_pdf')->getClientOriginalName();
            $relato->contenido_pdf = $nombre_pdf;
            // Guardamos el ID del usuario autenticado.
            $relato->user_id = Auth::id();
            // Guardamos el relato en la base de datos.
            $relato->save();
            // Guardamos el archivo PDF en la carpeta 'public/relatos'.
            $request->file('contenido_pdf')->storeAs('relatos', $nombre_pdf, 'public');

            // Guardamos los géneros del relato en la tabla pivote 'genero_relato'.
            // Como es un array, recorremos los géneros seleccionados.
            foreach ($request->generos as $genero_id) {
                // Para cada género, guardamos una fila en la tabla pivote.
                $relato->generos()->attach($genero_id);
            }

            // Redirigimos a la vista 'relatos.index' con un mensaje de éxito.
            return to_route('relatos.index')->with('success', 'Relato guardado correctamente.');
        } catch (QueryException $e) {
            // Retornamos a la vista anterior con un mensaje de error.
            return back()->with('error', 'Error al guardar el relato.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Relato $relato)
    {
        // Obtenemos la URL del directorio 'storage' donde se encuentra el archivo PDF.
        $url = 'storage/relatos/';
        // Retornamos la vista 'relatos.show' con el relato y la URL obtenidos.
        return view('relatos.show')->with('relato', $relato)->with('url', $url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relato $relato)
    {
        // Obtenemos todos los géneros literarios de la base de datos.
        $generos = Genero::all();
        // Obtenemos la URL del directorio 'storage' donde se encuentra el archivo PDF.
        $url = 'storage/relatos/';
        // Retornamos la vista 'relatos.edit' con el relato y la URL obtenidos.
        return view('relatos.edit')->with('relato', $relato)->with('url', $url)
            ->with('generos', $generos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relato $relato)
    {
        // Validamos los datos del formulario.
        $request->validate([
            'titulo' => 'required|string|max:255', // El título es obligatorio y tiene un máximo de 255 caracteres.
            'resumen' => 'required|string', // El resumen es obligatorio.
            'contenido_pdf' => 'file|mimes:pdf', // El contenido debe ser un archivo PDF.
            'generos' => 'required|array|min:1|max:4', // Se deben seleccionar entre 1 y 4 géneros.
        ]);

        // Actualizamos el relato.
        try {
            $relato->titulo = $request->titulo;
            $relato->resumen = $request->resumen;
            // Guardamos como fecha de publicación la fecha y hora actuales.
            $relato->fecha_publicacion = now();

            // Si se ha subido un nuevo archivo PDF, lo guardamos.
            if ($request->hasFile('contenido_pdf')) {
                // Eliminamos el archivo PDF anterior.
                Storage::disk('public')->delete('relatos/' . $relato->contenido_pdf);
                // Guardamos el nuevo archivo PDF.
                $nombre_pdf = time() . "_" . $request->file('contenido_pdf')->getClientOriginalName();
                $relato->contenido_pdf = $nombre_pdf;
                $request->file('contenido_pdf')->storeAs('relatos', $nombre_pdf, 'public');
            }

            // Guardamos el relato en la base de datos.
            $relato->save();

            // Eliminamos los géneros anteriores del relato.
            $relato->generos()->detach();

            // Guardamos los géneros del relato en la tabla pivote 'genero_relato'.
            // Como es un array, recorremos los géneros seleccionados.
            foreach ($request->generos as $genero_id) {
                // Para cada género, guardamos una fila en la tabla pivote.
                $relato->generos()->attach($genero_id);
            }

            // Redirigimos a la vista 'relatos.index' con un mensaje de éxito.
            return to_route('relatos.index')->with('success', 'Relato modificado correctamente.');
        } catch (QueryException $e) {
            // Retornamos a la vista anterior con un mensaje de error.
            return back()->with('error', 'Error al guardar el relato.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relato $relato)
    {
        // Borramos el relato de la base de datos.
        $relato->delete();
        // Borramos el archivo PDF del almacenamiento (no lo borramos si queremos conservarlo -> Soft Delete).
        // Storage::disk('public')->delete('relatos/' . $relato->contenido_pdf);
        // Redirigimos a la vista 'relatos.index' con un mensaje de éxito.
        return to_route('relatos.index')->with('success', 'Relato eliminado correctamente.');
    }

    /**
     * Descarga un relato en formato PDF.
     */
    public function download(Relato $relato)
    {
        // Ruta del archivo PDF dentro del almacenamiento
        $filePath = 'relatos/' . $relato->contenido_pdf;

        // Verificamos si el archivo existe en el almacenamiento público
        if (Storage::disk('public')->exists($filePath)) {
            // Si el archivo existe, lo descargamos con el nombre del relato y la extensión .pdf
            return Storage::disk('public')->download($filePath, $relato->titulo . '.pdf');
        }

        // Si el archivo no existe, redirigimos con un mensaje de error
        return back()->with('error', 'El archivo no se encuentra disponible.');
    }

}
