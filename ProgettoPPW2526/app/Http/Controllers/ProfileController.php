<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
// --- GESTIONE AVATAR ---
        if ($request->hasFile('avatar')) {
            // 1. Elimina la vecchia foto (se esiste fisicamente nella cartella public)
            if ($request->user()->avatar_path && file_exists(public_path($request->user()->avatar_path))) {
                unlink(public_path($request->user()->avatar_path));
            }

            // 2. Metodo Infallibile per Windows: salva DIRETTAMENTE in public/avatars
            $file = $request->file('avatar');
            $filename = $file->hashName(); // Genera un nome casuale (es. Ial2o9Yo...jpg)
            $file->move(public_path('avatars'), $filename); // Sposta il file fisicamente!

            // 3. Salva nel DB
            $request->user()->avatar_path = 'avatars/' . $filename;
        }

        // --- GESTIONE AVATAR ---
//        if ($request->hasFile('avatar')) {
//            // Elimina la vecchia foto se esiste
//            if ($request->user()->avatar_path) {
//                \Illuminate\Support\Facades\Storage::disk('public')->delete($request->user()->avatar_path);
//            }
//
//            // Salva la nuova foto
//            $path = $request->file('avatar')->store('avatars', 'public');
//            $request->user()->avatar_path = $path;
//        }
//
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina l'immagine profilo dell'utente.
     */
    public function destroyAvatar(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->user()->avatar_path) {
            // Elimina fisicamente il file dallo storage
            \Illuminate\Support\Facades\Storage::disk('public')->delete($request->user()->avatar_path);

            // Rimuovi il percorso dal database
            $request->user()->fill(['avatar_path' => null])->save();
        }

        return \Illuminate\Support\Facades\Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
