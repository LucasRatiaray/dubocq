<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user || !$user->roles->pluck('name')->intersect($roles)->count()) {
            // Redirection si l'utilisateur n'a pas les rôles requis
            return redirect()->route('home')->with('error', 'Vous n\'avez pas l\'accès requis.');
        }

        return $next($request);
    }
}
