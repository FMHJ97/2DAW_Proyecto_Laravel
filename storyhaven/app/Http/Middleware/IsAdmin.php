<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Comprobamos si el usuario autenticado es administrador.
        if (Auth::user()->role !== 'admin') {
            // Si no es administrador, redirigimos a la página de inicio con un mensaje de error.
            return redirect()->route('inicio');
        }

        return $next($request);
    }
}
