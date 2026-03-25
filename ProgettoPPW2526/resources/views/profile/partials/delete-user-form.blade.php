<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600 flex items-center gap-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            {{ __('Elimina Account') }}
        </h2>
        <p class="mt-1 text-sm text-red-500/80">
            {{ __('Una volta che il tuo account viene eliminato, tutte le sue risorse e i suoi dati saranno cancellati permanentemente. Prima di eliminare il tuo account, scarica i dati o le informazioni che desideri conservare.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white text-sm font-bold rounded-xl border border-red-200 hover:border-red-600 transition-all focus:outline-none focus:ring-2 focus:ring-red-500">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
        Elimina Definitivamente
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900">
                {{ __('Sei sicuro di voler eliminare il tuo account?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                {{ __('Una volta eliminato, tutti i dati andranno persi. Per confermare, inserisci la tua password qui sotto.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="{{ __('La tua password') }}"
                       class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-red-500 focus:border-red-500 block p-3 transition-colors">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                <button type="button" x-on:click="$dispatch('close')" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition-colors focus:outline-none">
                    {{ __('Annulla') }}
                </button>

                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-red-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    {{ __('Elimina Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
