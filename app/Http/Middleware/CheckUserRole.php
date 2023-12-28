<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        /*
        // Verifique se o usuário tem permissão para acessar a rota
        if (!auth()->user()->isAdmin()) {
            // Se não tiver permissão, redirecione ou retorne uma resposta adequada
            return redirect('/home')->with('error', 'Você não tem permissão para acessar esta página.');
        }
        */

        return $next($request);
    }
}
