<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Obtiene token del header Authorization Bearer o de la cookie
            $token = $request->bearerToken() ?? $request->cookie('token');

            if (!$token) {
                return redirect('/')->withErrors(['error' => 'No autenticado.']);
            }

            $user = JWTAuth::setToken($token)->parseToken()->authenticate();

            // Iniciar sesión en Laravel para que Auth::user() funcione
            auth()->login($user);

        } catch (JWTException $e) {
            return redirect('/')->withErrors(['error' => 'Token inválido o expirado.']);
        }

        return $next($request);
    }
}
