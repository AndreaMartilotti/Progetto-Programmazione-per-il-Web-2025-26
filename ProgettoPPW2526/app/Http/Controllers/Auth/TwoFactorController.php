<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.verify-2fa'); // La tua vista Blade
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        // Controlliamo se il codice inserito è uguale a quello in sessione
        if ($request->code == session('2fa_code')) {
            // Successo! Puliamo la sessione
            session()->forget(['2fa_code', '2fa_expires_at']);

            // Lo mandiamo finalmente alla dashboard
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Se sbaglia, lo rimandiamo indietro con un errore
        return back()->withErrors(['code' => 'Il codice inserito non è corretto.']);
    }
}
