<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté
        if (!$request->user()) {
            return redirect('error')->route('login');
        }

        // Vérifie si le rôle de l'utilisateur est autorisé
        foreach ($roles as $role) {
            if ($request->user()->role === $role) {
                return $next($request);
            }
        }

        // Redirige vers une page d'erreur ou renvoie une réponse interdite
        return redirect()->route('login');
    }
}
