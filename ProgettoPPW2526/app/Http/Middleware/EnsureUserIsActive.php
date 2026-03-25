<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se l'utente è loggato MA il suo account è disattivato (is_active = 0)
        if (Auth::check() && !Auth::user()->is_active) {

            // Log out forzato
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Ritorna alla login con errore
            return redirect()->route('login')->withErrors([
                'email' => 'Il tuo account è stato disabilitato. Contatta l\'amministratore.',
            ]);
        }

        return $next($request);
    }
}
