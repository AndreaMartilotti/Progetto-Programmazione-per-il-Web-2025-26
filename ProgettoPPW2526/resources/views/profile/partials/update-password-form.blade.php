<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            {{ __('Aggiorna Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Assicurati che il tuo account utilizzi una password lunga e casuale per rimanere al sicuro.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Password Attuale</label>
            <input type="password" id="update_password_current_password" name="current_password" autocomplete="current-password"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block p-3 transition-colors">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Nuova Password</label>
            <input type="password" id="update_password_password" name="password" autocomplete="new-password"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block p-3 transition-colors">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Conferma Password</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block p-3 transition-colors">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-gray-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                Salva Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm font-bold text-teal-600 flex items-center gap-1">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> Aggiornata.
                </p>
            @endif
        </div>
    </form>
</section>
