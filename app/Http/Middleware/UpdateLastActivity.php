<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return mixed|Response
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_activity_at = now();
            $user->save();
            Log::info('Dernière activité mise à jour pour l\'utilisateur ID : ' . $user->id);
        }

        return $next($request);
    }
}
