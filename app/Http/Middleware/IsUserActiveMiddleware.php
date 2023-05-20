<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->active) {
            auth()->logout();

            return redirect()->route('login')->with('warning', 'Seu usuário está inativado. Por favor, entre em contato com seu administrador.');
        }

        return $next($request);
    }
}
