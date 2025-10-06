<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Si el usuario no está autenticado, devuelve JSON en lugar de redirigir.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            abort(response()->json([
                'message' => 'No autenticado. Inicia sesión primero.'
            ], 401));
        }
    }
}
