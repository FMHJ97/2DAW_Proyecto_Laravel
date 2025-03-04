<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Comprobamos si el usuario autenticado es un usuario normal.
        if (Auth::user()->role !== 'user') {
            // Si no es un usuario normal, redirigimos a la página de inicio con un mensaje de error.
            return redirect()->route('inicio')->with('alert', [
                'type' => 'error',
                'message' => 'No tienes permisos para acceder a esta página.'
            ]);
        }
        // Si es un usuario normal, continuamos con la petición.
        return $next($request);
    }
}
