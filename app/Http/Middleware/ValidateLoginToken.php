<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class ValidateLoginToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el token del encabezado del request
        $token = $request->header('Authorization');

        // Validar el token con el sistema de Login
        $response = Http::withHeaders(['Authorization' => $token])->get('url_del_sistema_login/validate-token');

        // Verificar la respuesta del sistema de Login
        if ($response->status() == 200) {
            // Token válido, registra en la base de datos local si no existe
            // ...
            return $next($request);
        } else {
            // Token no válido, puedes devolver una respuesta de error
            return response()->json(['error' => 'Token no válido'], 401);
        }
    }
}
