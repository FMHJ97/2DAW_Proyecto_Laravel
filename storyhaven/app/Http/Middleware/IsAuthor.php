<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtenemos el relato a través de la ruta.
        $relato = $request->route('relato');
        // Comprobamos si el relato existe y si el usuario autenticado es el autor.
        if (!$relato || $relato->user_id !== Auth::id()) {
            // Si no es el autor, redirigimos a la página de inicio con un mensaje de error.
            return to_route('relatos.all')->with('alert', [
                'type' => 'error',
                'message' => 'No tienes permisos para acceder a esta página.'
            ]);
        }

        return $next($request);
    }
}
