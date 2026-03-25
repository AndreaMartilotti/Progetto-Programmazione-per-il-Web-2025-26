<x-guest-layout>

{{-- Intestazione --}}
<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Grazie per aver effettuato l\'accesso! Per proteggere il tuo account, inserisci il codice di sicurezza a 6 cifre che abbiamo appena inviato al tuo indirizzo email.') }}
</div>

{{-- Mostra errori generali (es. Codice scaduto o errato) --}}
@if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="font-medium text-red-600 text-sm flex items-center gap-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            Attenzione
        </div>
        <ul class="mt-2 list-disc list-inside text-xs text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form Principale --}}
<form method="POST" action="{{ route('verify.store') }}">
    @csrf

    <div class="mt-4">
        <x-input-label for="code" :value="__('Codice di Sicurezza (6 cifre)')" class="font-bold text-gray-700" />

        {{--
            UX Trick:
            - tracking-[0.5em] distanzia i numeri
            - font-mono rende i caratteri della stessa larghezza
            - text-center per un look da vera "OTP"
        --}}
        <x-text-input id="code"
                      class="block mt-2 w-full text-center text-3xl tracking-[0.5em] font-mono py-3"
                      type="text"
                      inputmode="numeric"
                      pattern="[0-9]*"
                      name="code"
                      required
                      autofocus
                      maxlength="6"
                      autocomplete="one-time-code"
                      placeholder="••••••" />

        <x-input-error :messages="$errors->get('code')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between mt-8">

        <a class="underline text-sm text-gray-500 hover:text-gray-900 transition-colors rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
           href="#"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Annulla e fai il Logout') }}
        </a>

        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-md transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
            {{ __('Verifica Codice') }}
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </div>
</form>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

</x-guest-layout>
