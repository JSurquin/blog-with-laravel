<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->user()->hasRole($role)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Vous n\'avez pas les permissions pour accéder à cette page.');
    }
}
