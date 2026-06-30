<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RestringirInvitado
{
    public function handle(Request $request, Closure $next): Response
    {
        // EXCEPCIÓN CORREGIDA: Si la petición es para cerrar sesión, la dejamos pasar sin evaluar
        if ($request->is('logout') || str_contains($request->url(), '/logout')) {
            return $next($request);
        }

        // Si el usuario es Invitado, bloqueamos los intentos de modificar datos
        if (Auth::check() && Auth::user()->role === 'Invitado') {
            
            if ($request->isMethod('post') || 
                $request->isMethod('put') || 
                $request->isMethod('patch') || 
                $request->isMethod('delete') || 
                str_contains($request->url(), '/create') || 
                str_contains($request->url(), '/edit')) {
                
                abort(403, 'Acción no autorizada. Tu cuenta de Invitado solo permite la lectura de datos.');
            }
        }

        return $next($request);
    }
}
