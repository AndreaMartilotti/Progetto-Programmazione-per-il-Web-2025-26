<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Mostra la pagina di Gestione Utenti
     */
    public function index()
    {
        $currentUser = Auth::user();

        // Sicurezza: Solo founder e admin accedono
        if (!in_array($currentUser->role, ['founder', 'admin'])) {
            abort(403, 'Accesso non autorizzato.');
        }

        // Mappiamo gli stati sul tuo database esatto:
        // 1. In attesa: non cestinati e is_active = false
        $pendingUsers = User::where('is_active', false)->latest()->get();

        // 2. Attivi: non cestinati e is_active = true
        $activeUsers = User::where('is_active', true)->latest()->get();

        // 3. Bannati: utenti cestinati (Soft Delete)
        $bannedUsers = User::onlyTrashed()->latest()->get();

        return view('users.index', compact('pendingUsers', 'activeUsers', 'bannedUsers'));
    }

    /**
     * Approva un utente in attesa
     */
    public function approve(User $user)
    {
        $this->authorizeAdminOrFounder();

        if ($user->is_active) {
            return back()->with('error', 'Questo utente è già attivo.');
        }

        $user->update(['is_active' => true]);

        return back()->with('success', "Utente {$user->name} approvato con successo.");
    }

    /**
     * Banna un utente (Soft Delete) rispettando la gerarchia
     */
    public function ban($id)
    {
        $currentUser = Auth::user();
        $this->authorizeAdminOrFounder();

        // Cerchiamo l'utente (non usiamo il Route Model Binding automatico
        // nel caso in cui stiamo tentando azioni strane)
        $user = User::findOrFail($id);

        // 1. Non puoi bannare te stesso
        if ($currentUser->id === $user->id) {
            return back()->with('error', 'Non puoi bannare te stesso.');
        }

        // 2. LOGICA GERARCHICA: Founder >> Admin >> User
        if ($currentUser->role === 'admin') {
            // Un Admin NON può bannare un Founder né un altro Admin
            if (in_array($user->role, ['founder', 'admin'])) {
                return back()->with('error', 'Azione non consentita: gerarchia insufficiente.');
            }
        }

        // 3. Eseguiamo il ban (Soft Delete)
        $user->delete();

        return back()->with('success', "Utente {$user->name} bannato dal sistema.");
    }

    /**
     * Riabilita un utente bannato
     */
    public function restore($id)
    {
        $this->authorizeAdminOrFounder();

        // Dobbiamo cercare tra i "cestinati" per trovarlo
        $user = User::onlyTrashed()->findOrFail($id);

        // Ripristiniamo dal cestino e ci assicuriamo che sia attivo
        $user->restore();
        $user->update(['is_active' => true]);

        return back()->with('success', "Utente {$user->name} riabilitato.");
    }

    /**
     * Helper per verificare i permessi base
     */
    private function authorizeAdminOrFounder()
    {
        if (!in_array(Auth::user()->role, ['founder', 'admin'])) {
            abort(403, 'Azione non consentita.');
        }
    }
}
