<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est authentifié et est un administrateur
        // Auth::check() : vérifie si l'utilisateur est authentifié
        // Auth::user() : récupère l'utilisateur actuellement authentifié
        // is_admin === 1 : on vérifie que l'utilisateur a le rôle d'administrateur
        if (Auth::check() && Auth::user()->is_admin === 1) {
            // Si l'utilisateur est un administrateur, la requête peut continuer
            // Cela permet à l'utilisateur d'accéder à la page qu'il demande
            return $next($request);
        }

        // Si l'utilisateur n'est pas authentifié ou n'est pas un administrateur, on le redirige
        // Retourne une redirection vers la page d'accueil (ou une autre page si vous souhaitez)
        // avec un message d'erreur indiquant qu'il n'a pas accès à cette page
        return redirect('/')->with('error', 'Vous n\'avez pas accès à cette page.');
    }
}
