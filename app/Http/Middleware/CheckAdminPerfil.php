<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        if (auth()->user()->perfil_id == 2) {
            return redirect('/home')->with('error', 'No cumples con los permisos necesarios para acceder a esta página.');
        }

        return $next($request);
    }
}
