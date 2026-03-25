<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTwoFactor
{
    public function handle(Request $request, Closure $next)
    {
        // Se l'utente è loggato e c'è un codice 2FA pendente nella sessione
        if (auth()->check() && session()->has('2fa_code')) {

            // Controlliamo se è scaduto
            if (now()->greaterThan(session('2fa_expires_at'))) {
                session()->forget(['2fa_code', '2fa_expires_at']);
                auth()->logout();
                return redirect()->route('login')->withErrors(['email' => 'Il codice 2FA è scaduto. Riprova.']);
            }

            // Se sta provando ad andare ovunque tranne che alla pagina di verifica, lo blocchiamo
            if (!$request->is('verify-2fa*')) {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
