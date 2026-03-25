<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Informazioni Profilo') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Aggiorna le informazioni del tuo account, l'indirizzo email e la tua foto profilo.") }}
        </p>
    </header>

    {{-- ATTENZIONE: Aggiunto enctype="multipart/form-data" per supportare l'upload del file --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- AVATAR UPLOAD (Gestito con Alpine per la Preview) --}}
        <div x-data="{ photoName: null, photoPreview: null }" class="flex items-center gap-6 pb-6 border-b border-gray-100">

            <input type="file" id="avatar" name="avatar" class="hidden"
                   x-ref="avatar"
                   x-on:change="
                        photoName = $refs.avatar.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => { photoPreview = e.target.result; };
                        reader.readAsDataURL($refs.avatar.files[0]);
                   " />

            {{-- Cerchio Immagine --}}
            <div class="relative w-20 h-20 shrink-0">
                {{-- Immagine attuale (se esiste e non c'è preview) --}}
                <div x-show="!photoPreview" class="w-full h-full rounded-full overflow-hidden border-4 border-gray-50 shadow-sm bg-gray-100 flex items-center justify-center">
                    @if($user->avatar_path)
                        <img src="{{ asset($user->avatar_path) }}" alt="{{ $user->name }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-2xl font-bold text-gray-400">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>

                {{-- Anteprima Nuova Immagine --}}
                <div x-show="photoPreview" style="display: none;" class="w-full h-full rounded-full overflow-hidden border-4 border-teal-50 shadow-sm">
                    <span class="block w-full h-full bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                </div>
            </div>

            {{-- Bottoni Upload e Rimozione --}}
            <div>
                <label for="avatar" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Foto Profilo</label>
                <div class="flex items-center gap-3">
                    <button type="button" x-on:click.prevent="$refs.avatar.click()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded-xl shadow-sm hover:bg-gray-50 hover:border-teal-300 hover:text-teal-700 transition-all focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        Carica Immagine
                    </button>

                    {{-- Mostra il bottone Rimuovi solo se c'è un'immagine --}}
                    @if($user->avatar_path)
                        <button type="button" onclick="document.getElementById('delete-avatar-form').submit();" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-red-200 text-red-600 text-xs font-bold rounded-xl shadow-sm hover:bg-red-50 hover:border-red-300 transition-all focus:outline-none focus:ring-2 focus:ring-red-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            Rimuovi
                        </button>
                    @endif
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        {{-- NAME --}}
        <div>
            <label for="name" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Nome Completo</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block p-3 transition-colors">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- EMAIL --}}
        <div>
            <label for="email" class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Indirizzo Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block p-3 transition-colors">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-amber-50 rounded-xl border border-amber-200 flex items-start gap-3">
                    <svg class="h-5 w-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        <p class="text-sm text-amber-800 font-medium">Il tuo indirizzo email non è verificato.</p>
                        <button form="send-verification" class="mt-1 text-xs font-bold text-amber-600 hover:text-amber-900 underline focus:outline-none">
                            Clicca qui per inviare di nuovo l'email di verifica.
                        </button>
                    </div>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-xs font-medium text-emerald-600">Un nuovo link di verifica è stato inviato al tuo indirizzo email.</p>
                @endif
            @endif
        </div>

        {{-- SAVE BUTTON --}}
        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-teal-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                Salva Modifiche
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm font-bold text-teal-600 flex items-center gap-1">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> Salvato.
                </p>
            @endif
        </div>
    </form>
</section>

@if($user->avatar_path)
    <form id="delete-avatar-form" action="{{ route('profile.avatar.destroy') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endif
