<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado
        if (!Auth::check()) {
            // Redireciona pro login se não estiver logado
            return redirect()->route('login');
        }
    
        // Verifica se o usuário NÃO é admin
        if (Auth::user()->nivel != 1) {
            // Redireciona para a home (ou qualquer outra rota não-admin)
            return redirect()->route('index');
        }

        return $next($request);
    }
}
